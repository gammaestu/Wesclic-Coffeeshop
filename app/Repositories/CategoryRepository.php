<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class CategoryRepository
{
    /**
     * Cache duration in minutes.
     */
    protected const CACHE_DURATION = 120; // Categories change less frequently

    /**
     * Get all active categories with their menus.
     */
    public function getActiveWithMenus(): Collection
    {
        return Cache::remember('categories.active', self::CACHE_DURATION, function () {
            return Category::where('status', 'aktif')
                ->with(['activeMenus' => function ($query) {
                    $query->where('status', 'tersedia')
                        ->orderBy('name')
                        ->select('id', 'category_id', 'name', 'price', 'image', 'stock');
                }])
                ->orderBy('name')
                ->get();
        });
    }

    /**
     * Get all active categories.
     */
    public function getActive(): Collection
    {
        return Cache::remember('categories.active.simple', self::CACHE_DURATION, function () {
            return Category::where('status', 'aktif')
                ->orderBy('name')
                ->get(['id', 'name', 'description']);
        });
    }

    /**
     * Clear category cache.
     */
    public function clearCache(): void
    {
        Cache::forget('categories.active');
        Cache::forget('categories.active.simple');
    }
}