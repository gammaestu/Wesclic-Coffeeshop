<?php

namespace App\Repositories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class MenuRepository
{
    /**
     * Cache duration in minutes.
     */
    protected const CACHE_DURATION = 60;

    /**
     * Get all available menus with category relationship.
     */
    public function getAvailable(): Collection
    {
        return Cache::remember('menus.available', self::CACHE_DURATION, function () {
            return Menu::where('status', 'tersedia')
                ->where('stock', '>', 0)
                ->with('category:id,name')
                ->orderBy('name')
                ->get();
        });
    }

    /**
     * Find menu by ID with category.
     */
    public function findWithCategory(int $id): ?Menu
    {
        return Cache::remember("menu.{$id}", self::CACHE_DURATION, function () use ($id) {
            return Menu::with('category')
                ->find($id);
        });
    }

    /**
     * Clear menu cache.
     */
    public function clearCache(): void
    {
        Cache::forget('menus.available');
    }

    /**
     * Clear specific menu cache.
     */
    public function clearMenuCache(int $id): void
    {
        Cache::forget("menu.{$id}");
    }
}