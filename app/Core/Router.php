<?php
/**
 * Hair Aura - Router Class
 * 
 * Handles URL routing, middleware, and request dispatching
 * Supports dynamic routes with parameters
 * 
 * @package HairAura\Core
 * @author Hair Aura Team
 * @version 1.0.0
 */

namespace App\Core;

use Exception;

class Router
{
    /** @var array Registered routes */
    private array $routes = [];
    
    /** @var array Route parameters */
    private array $params = [];
    
    /** @var array Middleware stack */
    private array $middleware = [];
    
    /** @var string Current route pattern */
    private string $currentGroup = '';
    
    /**
     * Add a GET route
     * 
     * @param string $route Route pattern
     * @param callable|array $callback Controller@method or closure
     * @return self
     */
    public function get(string $route, $callback): self
    {
        return $this->addRoute('GET', $route, $callback);
    }
    
    /**
     * Add a POST route
     * 
     * @param string $route Route pattern
     * @param callable|array $callback Controller@method or closure
     * @return self
     */
    public function post(string $route, $callback): self
    {
        return $this->addRoute('POST', $route, $callback);
    }
    
    /**
     * Add a PUT route
     * 
     * @param string $route Route pattern
     * @param callable|array $callback Controller@method or closure
     * @return self
     */
    public function put(string $route, $callback): self
    {
        return $this->addRoute('PUT', $route, $callback);
    }
    
    /**
     * Add a DELETE route
     * 
     * @param string $route Route pattern
     * @param callable|array $callback Controller@method or closure
     * @return self
     */
    public function delete(string $route, $callback): self
    {
        return $this->addRoute('DELETE', $route, $callback);
    }
    
    /**
     * Add route for multiple methods
     * 
     * @param array $methods HTTP methods
     * @param string $route Route pattern
     * @param callable|array $callback
     * @return self
     */
    public function match(array $methods, string $route, $callback): self
    {
        foreach ($methods as $method) {
            $this->addRoute(strtoupper($method), $route, $callback);
        }
        return $this;
    }
    
    /**
     * Add route for any method
     * 
     * @param string $route Route pattern
     * @param callable|array $callback
     * @return self
     */
    public function any(string $route, $callback): self
    {
        return $this->addRoute('ANY', $route, $callback);
    }
    
    /**
     * Group routes with common prefix/middleware
     * 
     * @param string $prefix Route prefix
     * @param callable $callback Routes definition
     * @return self
     */
    public function group(string $prefix, callable $callback): self
    {
        $previousGroup = $this->currentGroup;
        $this->currentGroup = $previousGroup . $prefix;
        $callback($this);
        $this->currentGroup = $previousGroup;
        return $this;
    }
    
    /**
     * Add middleware to routes
     * 
     * @param string|array $middleware Middleware class(es)
     * @param callable $callback Routes definition
     * @return self
     */
    public function middleware($middleware, callable $callback): self
    {
        $previousMiddleware = $this->middleware;
        $this->middleware = array_merge($this->middleware, (array) $middleware);
        $callback($this);
        $this->middleware = $previousMiddleware;
        return $this;
    }
    
    /**
     * Add a route to the registry
     * 
     * @param string $method HTTP method
     * @param string $route Route pattern
     * @param callable|array $callback
     * @return self
     */
    private function addRoute(string $method, string $route, $callback): self
    {
        $route = $this->currentGroup . $route;
        
        // Convert route to regex pattern
        $pattern = $this->convertRouteToRegex($route);
        
        $this->routes[$method][$pattern] = [
            'callback' => $callback,
            'middleware' => $this->middleware,
            'original' => $route
        ];
        
        return $this;
    }
    
    /**
     * Convert route pattern to regex
     * 
     * @param string $route
     * @return string
     */
    private function convertRouteToRegex(string $route): string
    {
        // Keep constrained params intact (e.g. {id:\d+}) while escaping static path text.
        $constraintTokens = [];
        $route = preg_replace_callback(
            '/\{(\w+):([^}]+)\}/',
            function (array $matches) use (&$constraintTokens): string {
                $token = '__ROUTE_CONSTRAINT_' . count($constraintTokens) . '__';
                $constraintTokens[$token] = '(?P<' . $matches[1] . '>' . $matches[2] . ')';
                return $token;
            },
            $route
        );

        // Escape special regex characters except {}
        $route = preg_replace('/[\.\+\*\?\^\$\[\]\|]/', '\\$0', $route);

        if (!empty($constraintTokens)) {
            $route = str_replace(array_keys($constraintTokens), array_values($constraintTokens), $route);
        }
        
        // Convert {param} to named capture groups
        $route = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $route);
        
        // Convert {param?} to optional named capture groups
        $route = preg_replace('/\{(\w+)\?\}/', '(?P<$1>[^/]*)', $route);
        
        // Convert {param:\d+} to constrained named capture groups
        $route = preg_replace('/\{(\w+):([^}]+)\}/', '(?P<$1>$2)', $route);
        
        return '#^' . $route . '$#';
    }
    
    /**
     * Dispatch the current request
     * 
     * @param string $url Request URL
     * @param string $method HTTP method
     * @return mixed
     * @throws Exception If route not found
     */
    public function dispatch(string $url, string $method)
    {
        // Remove query string
        $url = parse_url($url, PHP_URL_PATH) ?? $url;
        
        // Remove trailing slash except for root
        $url = rtrim($url, '/') ?: '/';
        
        // Check for method override (for forms)
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }
        
        // Try exact method first, then ANY
        $methodsToTry = [$method, 'ANY'];
        
        foreach ($methodsToTry as $httpMethod) {
            if (!isset($this->routes[$httpMethod])) {
                continue;
            }
            
            foreach ($this->routes[$httpMethod] as $pattern => $route) {
                if (preg_match($pattern, $url, $matches)) {
                    // Extract named parameters
                    $this->params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    
                    // Run middleware
                    foreach ($route['middleware'] as $middleware) {
                        $this->runMiddleware($middleware);
                    }
                    
                    return $this->executeCallback($route['callback']);
                }
            }
        }
        
        // No route found
        throw new Exception('Page not found', 404);
    }
    
    /**
     * Execute route callback
     * 
     * @param callable|array $callback
     * @return mixed
     */
    private function executeCallback($callback)
    {
        // Use positional arguments to avoid PHP 8 named-parameter mismatches
        // when route tokens (e.g. {category}) don't match method parameter names.
        $args = array_values($this->params);

        if (is_callable($callback)) {
            return call_user_func_array($callback, $args);
        }
        
        if (is_array($callback) && count($callback) === 2) {
            $controller = $callback[0];
            $method = $callback[1];
            
            // Full namespace path
            if (strpos($controller, '\\') === false) {
                $controller = "App\\Controllers\\{$controller}";
            }
            
            if (!class_exists($controller)) {
                throw new Exception("Controller {$controller} not found", 500);
            }
            
            $instance = new $controller();
            
            if (!method_exists($instance, $method)) {
                throw new Exception("Method {$method} not found in {$controller}", 500);
            }
            
            return call_user_func_array([$instance, $method], $args);
        }
        
        throw new Exception('Invalid route callback', 500);
    }
    
    /**
     * Run middleware
     * 
     * @param string $middleware
     * @throws Exception If middleware fails
     */
    private function runMiddleware(string $middleware): void
    {
        if (strpos($middleware, '\\') === false) {
            $middleware = "App\\Middleware\\{$middleware}";
        }
        
        if (!class_exists($middleware)) {
            throw new Exception("Middleware {$middleware} not found", 500);
        }
        
        $instance = new $middleware();
        
        if (!method_exists($instance, 'handle')) {
            throw new Exception("Middleware must have handle method", 500);
        }
        
        $result = $instance->handle();
        
        if ($result === false) {
            throw new Exception('Unauthorized', 403);
        }
    }
    
    /**
     * Get current route parameters
     * 
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
    
    /**
     * Get a specific parameter
     * 
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getParam(string $name, $default = null)
    {
        return $this->params[$name] ?? $default;
    }
    
    /**
     * Generate URL for named route
     * 
     * @param string $name Route name
     * @param array $params Route parameters
     * @return string
     */
    public function url(string $name, array $params = []): string
    {
        foreach ($this->routes as $method => $routes) {
            foreach ($routes as $pattern => $route) {
                if (isset($route['name']) && $route['name'] === $name) {
                    $url = $route['original'];
                    foreach ($params as $key => $value) {
                        $url = str_replace("{{$key}}", $value, $url);
                        $url = str_replace("{{$key}?}", $value, $url);
                    }
                    return $url;
                }
            }
        }
        
        throw new Exception("Route {$name} not found");
    }
    
    /**
     * Redirect to URL
     * 
     * @param string $url
     * @param int $code HTTP status code
     */
    public function redirect(string $url, int $code = 302): void
    {
        http_response_code($code);
        header('Location: ' . $this->resolveRedirectUrl($url));
        exit;
    }

    /**
     * Resolve redirect URL against app base path for subdirectory installs.
     */
    private function resolveRedirectUrl(string $url): string
    {
        $trimmed = trim($url);
        if ($trimmed === '') {
            return '/';
        }

        if (preg_match('#^(?:[a-z][a-z0-9+.-]*:)?//#i', $trimmed)) {
            return $trimmed;
        }

        $basePath = rtrim((string) ($GLOBALS['app_base_url'] ?? ''), '/');
        if ($basePath === '') {
            return str_starts_with($trimmed, '/') ? $trimmed : '/' . ltrim($trimmed, '/');
        }

        if ($trimmed === $basePath || str_starts_with($trimmed, $basePath . '/')) {
            return $trimmed;
        }

        if (str_starts_with($trimmed, '/')) {
            return $basePath . $trimmed;
        }

        return $basePath . '/' . ltrim($trimmed, '/');
    }
    
    /**
     * Get all registered routes
     * 
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}
