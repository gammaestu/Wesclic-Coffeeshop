<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Services\MenuService;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function __construct(
        protected MenuService $menuService,
        protected CategoryRepository $categoryRepository
    ) {}

    /**
     * Display the menu page.
     */
    public function index(Request $request): View
    {
        $categories = $this->categoryRepository->getActiveWithMenus();
        $selectedCategory = $request->get('category');
        $menus = $this->menuService->getMenusByCategory($selectedCategory);

        return view('pages.menu', [
            'categories' => $categories,
            'menus' => $menus,
            'selectedCategory' => $selectedCategory,
        ]);
    }

    /**
     * Display menu detail page.
     */
    public function show(Menu $menu): View
    {
        $menu->load('category');

        return view('pages.menu-detail', [
            'menu' => $menu,
        ]);
    }
}