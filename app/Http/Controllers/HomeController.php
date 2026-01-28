<?php

namespace App\Http\Controllers;

use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected MenuService $menuService
    ) {}

    /**
     * Display the home page.
     */
    public function index(): View
    {
        $popularItems = $this->menuService->getPopularItems(3);

        return view('pages.home', [
            'popularItems' => $popularItems,
        ]);
    }
}