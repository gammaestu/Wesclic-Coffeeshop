<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        // Simple starter gallery: use static assets in public/images (can be replaced with DB later)
        $images = [
            asset('images/logos/menu-americano.svg'),
            asset('images/logos/menu-latte.svg'),
            asset('images/logos/menu-cappuccino.svg'),
            asset('images/logos/menu-croissant.svg'),
            asset('images/logos/menu-cheesecake.svg'),
            asset('images/logos/menu-tiramisu.svg'),
        ];

        return view('pages.gallery', [
            'images' => $images,
        ]);
    }
}

