<?php
/**
 * Hair Aura - View Component
 * 
 * Handles template rendering, layout management, and view data
 * Supports sections, layouts, and partials
 * 
 * @package HairAura\Core
 * @author Hair Aura Team
 * @version 1.0.0
 */

namespace App\Core;

use Exception;

class View
{
    /** @var string Views directory */
    private static string $viewPath = __DIR__ . '/../Views/';
    
    /** @var string Default layout */
    private static string $defaultLayout = 'layouts/main';
    
    /** @var array Shared data across all views */
    private static array $sharedData = [];
    
    /** @var array Section content */
    private static array $sections = [];
    
    /** @var string Current section being captured */
    private static ?string $currentSection = null;
    
    /** @var array Stack of captured content */
    private static array $sectionStack = [];
    
    /**
     * Render a view
     * 
     * @param string $view View path (dot notation)
     * @param array $data Data to pass to view
     * @param string|null $layout Layout to use (null for no layout)
     * @return string Rendered content
     */
    public static function render(string $view, array $data = [], ?string $layout = null): string
    {
        // Merge shared data
        $data = array_merge(self::$sharedData, $data);
        
        // Extract data for view
        extract($data);
        
        // Start output buffering
        ob_start();
        
        // Include view file
        $viewFile = self::resolveViewPath($view);
        
        if (!file_exists($viewFile)) {
            throw new Exception("View not found: {$view}");
        }
        
        include $viewFile;
        
        // Get view content
        $content = ob_get_clean();
        
        // Wrap in layout if specified
        if ($layout !== null) {
            $layoutFile = self::resolveViewPath($layout ?: self::$defaultLayout);
            
            if (!file_exists($layoutFile)) {
                throw new Exception("Layout not found: {$layout}");
            }
            
            // Store content in section
            self::$sections['content'] = $content;
            
            // Render layout
            ob_start();
            include $layoutFile;
            $content = ob_get_clean();
        }
        
        return $content;
    }
    
    /**
     * Render view and output directly
     * 
     * @param string $view View path
     * @param array $data Data to pass
     * @param string|null $layout Layout to use
     */
    public static function make(string $view, array $data = [], ?string $layout = null): void
    {
        echo self::render($view, $data, $layout);
    }
    
    /**
     * Include a partial view
     * 
     * @param string $partial Partial path
     * @param array $data Data to pass
     */
    public static function partial(string $partial, array $data = []): void
    {
        echo self::render("partials/{$partial}", $data, null);
    }
    
    /**
     * Start a section
     * 
     * @param string $name Section name
     */
    public static function section(string $name): void
    {
        if (self::$currentSection !== null) {
            self::$sectionStack[] = self::$currentSection;
        }
        
        self::$currentSection = $name;
        ob_start();
    }
    
    /**
     * End a section
     */
    public static function endSection(): void
    {
        if (self::$currentSection === null) {
            throw new Exception('No section started');
        }
        
        self::$sections[self::$currentSection] = ob_get_clean();
        
        if (!empty(self::$sectionStack)) {
            self::$currentSection = array_pop(self::$sectionStack);
        } else {
            self::$currentSection = null;
        }
    }
    
    /**
     * Yield a section
     * 
     * @param string $name Section name
     * @param string $default Default content
     */
    public static function yield(string $name, string $default = ''): void
    {
        echo self::$sections[$name] ?? $default;
    }
    
    /**
     * Check if section exists
     * 
     * @param string $name Section name
     * @return bool
     */
    public static function hasSection(string $name): bool
    {
        return isset(self::$sections[$name]) && !empty(self::$sections[$name]);
    }
    
    /**
     * Share data across all views
     * 
     * @param string|array $key Key or array of data
     * @param mixed $value Value (if key is string)
     */
    public static function share($key, $value = null): void
    {
        if (is_array($key)) {
            self::$sharedData = array_merge(self::$sharedData, $key);
        } else {
            self::$sharedData[$key] = $value;
        }
    }
    
    /**
     * Set default layout
     * 
     * @param string $layout Layout path
     */
    public static function setDefaultLayout(string $layout): void
    {
        self::$defaultLayout = $layout;
    }
    
    /**
     * Set views directory
     * 
     * @param string $path Directory path
     */
    public static function setViewPath(string $path): void
    {
        self::$viewPath = rtrim($path, '/') . '/';
    }
    
    /**
     * Resolve view path from dot notation
     * 
     * @param string $view View path
     * @return string Full file path
     */
    private static function resolveViewPath(string $view): string
    {
        $path = str_replace('.', '/', $view);
        return self::$viewPath . $path . '.php';
    }
    
    /**
     * Escape HTML entities
     * 
     * @param string $text Text to escape
     * @return string
     */
    public static function e(string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
    
    /**
     * Format price
     * 
     * @param float $amount Amount
     * @param string $currency Currency code
     * @return string Formatted price
     */
    public static function price(float $amount, string $currency = 'GHS'): string
    {
        $symbols = [
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            'GHS' => 'GH₵'
        ];
        
        $symbol = $symbols[$currency] ?? $currency . ' ';
        return $symbol . number_format($amount, 2);
    }
    
    /**
     * Generate asset URL
     * 
     * @param string $path Asset path
     * @return string Full URL
     */
    public static function asset(string $path): string
    {
        if (function_exists('asset')) {
            return asset($path);
        }

        $baseUrl = rtrim($_ENV['APP_URL'] ?? '', '/');
        return $baseUrl . '/' . ltrim($path, '/');
    }
    
    /**
     * Generate route URL
     * 
     * @param string $route Route path
     * @param array $params Route parameters
     * @return string Full URL
     */
    public static function url(string $route, array $params = []): string
    {
        if (function_exists('url')) {
            $url = url($route);
        } else {
            $baseUrl = rtrim($_ENV['APP_URL'] ?? '', '/');
            $url = $baseUrl . '/' . ltrim($route, '/');
        }
        
        if (!empty($params)) {
            $url .= (strpos($url, '?') === false ? '?' : '&') . http_build_query($params);
        }
        
        return $url;
    }
    
    /**
     * Get old input value
     * 
     * @param string $key Input key
     * @param mixed $default Default value
     * @return mixed
     */
    public static function old(string $key, $default = '')
    {
        return $_SESSION['old_input'][$key] ?? $default;
    }
    
    /**
     * Get validation errors
     * 
     * @param string|null $field Specific field
     * @return array|string|null
     */
    public static function errors(?string $field = null)
    {
        $errors = $_SESSION['errors'] ?? [];
        
        if ($field !== null) {
            return $errors[$field] ?? null;
        }
        
        return $errors;
    }
    
    /**
     * Check if there are errors
     * 
     * @return bool
     */
    public static function hasErrors(): bool
    {
        return !empty($_SESSION['errors']);
    }
    
    /**
     * Clear flash data
     */
    public static function clearFlash(): void
    {
        unset($_SESSION['old_input']);
        unset($_SESSION['errors']);
        unset($_SESSION['success']);
        unset($_SESSION['error']);
    }
}
