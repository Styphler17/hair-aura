<?php
/**
 * Hair Aura - Image Manager
 * 
 * Handles file uploads and image conversions (WebP)
 * 
 * @package App\Core
 */

namespace App\Core;

class ImageManager
{
    /**
     * Upload and convert image to WebP
     * 
     * @param array $file The $_FILES['name'] array item
     * @param string $destinationFolder Relative path from public/ (e.g. 'uploads/products/')
     * @param string|null $filenamePrefix Optional prefix for filename
     * @param int $quality WebP quality (0-100)
     * @return string|null The resulting filename including extension, or null on failure
     */
    /**
     * Replace a specific file with an uploaded image (converted to WebP)
     * 
     * @param array $file The $_FILES item
     * @param string $relativePath Destination path from public root (e.g. 'img/logo.webp')
     * @param int $quality WebP quality
     * @return bool Success
     */
    public static function replace(array $file, string $relativePath, int $quality = 85): bool
    {
        if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);
        if (!in_array($mimeType, ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
            return false;
        }

        $publicRoot = __DIR__ . '/../../public/';
        $targetPath = $publicRoot . ltrim($relativePath, '/');
        
        $dir = dirname($targetPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // If target exists, delete it first to ensure clean write
        if (file_exists($targetPath)) {
            @unlink($targetPath);
        }

        return self::convertToWebP($file['tmp_name'], $targetPath, $mimeType, $quality);
    }

    public static function upload(array $file, string $destinationFolder, ?string $filenamePrefix = null, int $quality = 85): ?string
    {
        // Check for upload errors
        if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        // Validate MIME type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);

        if (!in_array($mimeType, $allowedTypes)) {
            return null;
        }

        // Prepare destination
        $publicRoot = __DIR__ . '/../../public/';
        $targetDir = $publicRoot . trim($destinationFolder, '/') . '/';
        
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // Generate filename
        $extension = 'webp'; // We are converting to WebP
        $prefix = $filenamePrefix ?? uniqid(time() . '_');
        $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
        // Sanitize original name
        $safeName = preg_replace('/[^a-z0-9\-_]/i', '', $originalName);
        $newFilename = $prefix . $safeName . '.' . $extension;
        $targetPath = $targetDir . $newFilename;

        // Process image
        $success = self::convertToWebP($file['tmp_name'], $targetPath, $mimeType, $quality);

        if ($success) {
            return $newFilename;
        }

        // Fallback: Just move the file if conversion fails
        $originalExt = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fallbackFilename = $prefix . $safeName . '.' . $originalExt;
        if (move_uploaded_file($file['tmp_name'], $targetDir . $fallbackFilename)) {
            return $fallbackFilename;
        }

        return null;
    }

    /**
     * Convert image file to WebP
     */
    private static function convertToWebP(string $sourcePath, string $targetPath, string $mimeType, int $quality): bool
    {
        try {
            $image = null;
            switch ($mimeType) {
                case 'image/jpeg':
                    $image = @imagecreatefromjpeg($sourcePath);
                    break;
                case 'image/png':
                    $image = @imagecreatefrompng($sourcePath);
                    if ($image) {
                        imagepalettetotruecolor($image);
                        imagealphablending($image, true);
                        imagesavealpha($image, true);
                    }
                    break;
                case 'image/gif':
                    $image = @imagecreatefromgif($sourcePath);
                    break;
                case 'image/webp':
                    // Already WebP, just move it (or re-save to ensure consistency)
                    return move_uploaded_file($sourcePath, $targetPath);
            }

            if (!$image) {
                return false;
            }

            // Save as WebP
            $result = imagewebp($image, $targetPath, $quality);
            
            // Free memory
            imagedestroy($image);
            
            return $result;
        } catch (\Throwable $e) {
            error_log('WebP conversion failed: ' . $e->getMessage());
            return false;
        }
    }
}
