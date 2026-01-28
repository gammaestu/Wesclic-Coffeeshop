<?php

namespace App\Services;

use App\Models\Menu;
use App\Repositories\MenuRepository;
use Illuminate\Support\Collection;

class MenuService
{
    public function __construct(
        protected MenuRepository $menuRepository
    ) {}

    /**
     * Get popular menu items for homepage.
     */
    public function getPopularItems(int $limit = 3): Collection
    {
        return $this->menuRepository->getAvailable()
            ->take($limit);
    }

    /**
     * Get menus by category.
     */
    public function getMenusByCategory(?string $categoryName = null): Collection
    {
        $menus = $this->menuRepository->getAvailable();

        if ($categoryName) {
            $menus = $menus->filter(function ($menu) use ($categoryName) {
                return strtolower($menu->category->name) === strtolower($categoryName);
            });
        }

        return $menus;
    }

    /**
     * Get menu by ID with category relationship.
     */
    public function getMenuById(int $id): ?Menu
    {
        return $this->menuRepository->findWithCategory($id);
    }
}