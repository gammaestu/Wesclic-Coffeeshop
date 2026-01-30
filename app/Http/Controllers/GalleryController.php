<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Gallery: gambar suasana kopi / orang minum kopi (bukan dari menu).
     * Sumber: config/gallery.php (bisa Unsplash atau URL lain).
     * Route: GET /gallery -> name('gallery')
     */
    public function index(): View
    {
        $items = collect(Config::get('gallery.images', []))
            ->map(function (array $row, int $index) {
                return [
                    'id' => 'gallery-' . ($index + 1),
                    'image_url' => $row['url'],
                    'caption' => $row['caption'] ?? 'Gallery',
                    'size' => in_array($row['size'] ?? '', ['tall', 'wide', 'square']) ? $row['size'] : 'square',
                ];
            })
            ->values();

        return view('pages.gallery', [
            'items' => $items,
        ]);
    }
}
