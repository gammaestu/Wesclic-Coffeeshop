<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Service for menu/category image uploads.
 * Supports PNG, JPG/JPEG, SVG (design pattern: Single Responsibility).
 */
class ImageService
{
    /** Allowed MIME types for menu images */
    public const ALLOWED_MIMES = [
        'image/png',
        'image/jpeg',
        'image/jpg',
        'image/svg+xml',
    ];

    /** Allowed extensions */
    public const ALLOWED_EXTENSIONS = ['png', 'jpg', 'jpeg', 'svg'];

    /** Max file size in KB (2MB) */
    public const MAX_SIZE_KB = 2048;

    /** Base path relative to public directory */
    public const UPLOAD_DIR = 'images/logos';

    /**
     * Validate uploaded file (type and size).
     */
    public function validate(UploadedFile $file): array
    {
        $errors = [];

        if (! in_array(strtolower($file->getClientOriginalExtension()), self::ALLOWED_EXTENSIONS, true)) {
            $errors[] = 'Format gambar harus PNG, JPG, atau SVG.';
        }

        if (! in_array($file->getMimeType(), self::ALLOWED_MIMES, true)) {
            $errors[] = 'Tipe file tidak diizinkan. Gunakan PNG, JPG, atau SVG.';
        }

        if ($file->getSize() > self::MAX_SIZE_KB * 1024) {
            $errors[] = 'Ukuran file maksimal ' . self::MAX_SIZE_KB . ' KB.';
        }

        return $errors;
    }

    /**
     * Store uploaded image to public/images/logos and return path for DB (e.g. images/logos/menu-abc123.png).
     */
    public function storeMenuImage(UploadedFile $file, ?string $prefix = 'menu'): string
    {
        $ext = strtolower($file->getClientOriginalExtension());
        $filename = Str::slug($prefix) . '-' . Str::random(8) . '.' . $ext;
        $dir = public_path(self::UPLOAD_DIR);

        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $file->move($dir, $filename);

        return self::UPLOAD_DIR . '/' . $filename;
    }

    /**
     * Delete image file by path (e.g. images/logos/menu-xxx.png).
     * Only deletes files under UPLOAD_DIR for safety.
     */
    public function deleteByPath(?string $path): bool
    {
        if (! $path || ! str_starts_with($path, self::UPLOAD_DIR . '/')) {
            return false;
        }

        $fullPath = public_path($path);

        if (is_file($fullPath)) {
            return unlink($fullPath);
        }

        return false;
    }
}
