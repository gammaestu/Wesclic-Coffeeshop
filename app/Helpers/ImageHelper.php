<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Get optimized image URL with lazy loading support.
     */
    public static function getImageUrl(?string $imagePath, ?string $fallback = null): ?string
    {
        if (!$imagePath) {
            return $fallback;
        }

        // If already a full URL, return as is
        if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
            return $imagePath;
        }

        // Return asset URL
        return asset($imagePath);
    }

    /**
     * Get image with lazy loading attributes.
     */
    public static function lazyImage(string $src, string $alt, array $attributes = []): string
    {
        $defaultAttributes = [
            'loading' => 'lazy',
            'decoding' => 'async',
            'alt' => $alt,
        ];

        $attributes = array_merge($defaultAttributes, $attributes);
        $attrString = '';

        foreach ($attributes as $key => $value) {
            $attrString .= " {$key}=\"" . htmlspecialchars($value, ENT_QUOTES) . "\"";
        }

        return "<img src=\"{$src}\"{$attrString}>";
    }

    /**
     * Generate responsive image srcset.
     */
    public static function responsiveSrcset(string $basePath, array $sizes = [100, 200, 400, 800]): string
    {
        $srcset = [];
        
        foreach ($sizes as $size) {
            // In a real app, you'd generate different sized images
            // For now, we'll use the same image
            $srcset[] = asset($basePath) . " {$size}w";
        }

        return implode(', ', $srcset);
    }
}