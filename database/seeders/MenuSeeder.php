<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

/**
 * Seeder menu dengan harga Rupiah (IDR) dan gambar lokal dari public/images/logos/
 * Design Pattern: Repository Pattern - menggunakan mapping untuk konsistensi data
 */
class MenuSeeder extends Seeder
{
    /**
     * Mapping nama menu ke nama file gambar lokal
     * Format: 'Nama Menu' => 'nama-file.jpeg'
     */
    private const MENU_IMAGE_MAPPING = [
        'Espresso' => 'menu-espresso.jpeg',
        'Americano' => 'menu-americano.jpeg',
        'Cappuccino' => 'menu-cappuccino.jpeg',
        'Latte' => 'menu-latte.jpeg',
        'Mocha' => 'menu-mocha.jpeg',
        'Macchiato' => 'menu-macchiato.jpeg',
        'Flat White' => 'menu-flat-white.jpeg',
        'Cold Brew' => 'menu-cold-brew.jpeg',
        'Green Tea' => 'menu-green-tea.jpeg',
        'Black Tea' => 'menu-black-tea.jpeg',
        'Chai Latte' => 'menu-chai-latte.jpeg',
        'Earl Grey' => 'menu-earl-grey.jpeg',
        'Herbal Tea' => 'menu-herbal-tea.jpeg',
        'Croissant' => 'menu-croissant.jpeg',
        'Chocolate Chip Cookie' => 'menu-chocolate-chip-cookie.jpeg',
        'Blueberry Muffin' => 'menu-blueberry-muffin.jpeg',
        'Cinnamon Roll' => 'menu-cinnamon-roll.jpeg',
        'Almond Croissant' => 'menu-almond-croissant.jpeg',
        'Tiramisu' => 'menu-tiramisu.jpeg',
        'Cheesecake' => 'menu-cheesecake.jpeg',
        'Chocolate Cake' => 'menu-chocolate-cake.jpeg',
        'Apple Pie' => 'menu-apple-pie.jpeg',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coffeeCategory = Category::where('name', 'Coffee')->first();
        $teaCategory = Category::where('name', 'Tea')->first();
        $pastryCategory = Category::where('name', 'Pastry')->first();
        $dessertCategory = Category::where('name', 'Dessert')->first();

        // Coffee Items — menggunakan gambar lokal (deskripsi Bahasa Indonesia)
        $coffeeItems = [
            ['name' => 'Espresso', 'description' => 'Espresso Italia yang pekat dan kuat, dasar sempurna untuk berbagai minuman kopi.', 'price' => 25000, 'stock' => 50, 'status' => 'tersedia'],
            ['name' => 'Americano', 'description' => 'Espresso yang dipadukan dengan air panas, rasa kopi yang ringan namun tetap kaya.', 'price' => 28000, 'stock' => 45, 'status' => 'tersedia'],
            ['name' => 'Cappuccino', 'description' => 'Perpaduan seimbang antara espresso, susu steam, dan foam lembut di atasnya.', 'price' => 32000, 'stock' => 60, 'status' => 'tersedia'],
            ['name' => 'Latte', 'description' => 'Espresso lembut dengan susu steam, disajikan dengan sedikit foam di permukaan.', 'price' => 35000, 'stock' => 55, 'status' => 'tersedia'],
            ['name' => 'Mocha', 'description' => 'Kombinasi nikmat espresso, cokelat, dan susu hangat dalam satu cangkir.', 'price' => 38000, 'stock' => 50, 'status' => 'tersedia'],
            ['name' => 'Macchiato', 'description' => 'Espresso kuat dengan sedikit foam susu di atasnya, cocok untuk pecinta kopi.', 'price' => 30000, 'stock' => 40, 'status' => 'tersedia'],
            ['name' => 'Flat White', 'description' => 'Dua shot espresso dengan microfoam halus, bertekstur lembut dan creamy.', 'price' => 32000, 'stock' => 45, 'status' => 'tersedia'],
            ['name' => 'Cold Brew', 'description' => 'Kopi seduh dingin yang direndam lama, rasa lebih smooth dan tidak terlalu asam.', 'price' => 35000, 'stock' => 35, 'status' => 'tersedia'],
        ];

        // Tea Items — menggunakan gambar lokal (deskripsi Bahasa Indonesia)
        $teaItems = [
            ['name' => 'Green Tea', 'description' => 'Teh hijau yang segar dan harum, kaya akan antioksidan.', 'price' => 25000, 'stock' => 40, 'status' => 'tersedia'],
            ['name' => 'Black Tea', 'description' => 'Teh hitam klasik dengan rasa kuat dan berkarakter.', 'price' => 25000, 'stock' => 40, 'status' => 'tersedia'],
            ['name' => 'Chai Latte', 'description' => 'Teh rempah hangat dengan susu, aroma harum dan menenangkan.', 'price' => 32000, 'stock' => 50, 'status' => 'tersedia'],
            ['name' => 'Earl Grey', 'description' => 'Teh hitam dengan aroma bergamot yang elegan dan lembut.', 'price' => 26000, 'stock' => 35, 'status' => 'tersedia'],
            ['name' => 'Herbal Tea', 'description' => 'Racikan teh herbal tanpa kafein untuk momen santai.', 'price' => 25000, 'stock' => 30, 'status' => 'tersedia'],
        ];

        // Pastry Items — menggunakan gambar lokal (deskripsi Bahasa Indonesia)
        $pastryItems = [
            ['name' => 'Croissant', 'description' => 'Croissant mentega ala Prancis yang berlapis dan renyah, dipanggang segar setiap hari.', 'price' => 22000, 'stock' => 25, 'status' => 'tersedia'],
            ['name' => 'Chocolate Chip Cookie', 'description' => 'Cookie cokelat chip dengan tekstur lembut di dalam dan renyah di luar.', 'price' => 18000, 'stock' => 30, 'status' => 'tersedia'],
            ['name' => 'Blueberry Muffin', 'description' => 'Muffin lembut dengan potongan blueberry asli yang manis dan juicy.', 'price' => 24000, 'stock' => 20, 'status' => 'tersedia'],
            ['name' => 'Cinnamon Roll', 'description' => 'Roti gulung kayu manis dengan saus gula dan cream cheese yang lembut.', 'price' => 28000, 'stock' => 18, 'status' => 'tersedia'],
            ['name' => 'Almond Croissant', 'description' => 'Croissant dengan isian almond manis dan taburan irisan almond di atasnya.', 'price' => 28000, 'stock' => 15, 'status' => 'tersedia'],
        ];

        // Dessert Items — menggunakan gambar lokal (deskripsi Bahasa Indonesia)
        $dessertItems = [
            ['name' => 'Tiramisu', 'description' => 'Dessert kopi klasik Italia dengan lapisan mascarpone dan ladyfinger yang direndam espresso.', 'price' => 42000, 'stock' => 12, 'status' => 'tersedia'],
            ['name' => 'Cheesecake', 'description' => 'Cheesecake gaya New York yang creamy dengan dasar biskuit renyah.', 'price' => 38000, 'stock' => 10, 'status' => 'tersedia'],
            ['name' => 'Chocolate Cake', 'description' => 'Kue cokelat lembut dengan rasa cokelat yang kaya dan topping krim cokelat.', 'price' => 35000, 'stock' => 8, 'status' => 'tersedia'],
            ['name' => 'Apple Pie', 'description' => 'Pie apel hangat dengan kayu manis dan kulit pie yang renyah.', 'price' => 32000, 'stock' => 10, 'status' => 'tersedia'],
        ];

        // Helper function untuk mendapatkan path gambar
        $getImagePath = function (string $menuName): ?string {
            $imageFile = self::MENU_IMAGE_MAPPING[$menuName] ?? null;
            if (!$imageFile) {
                return null;
            }

            $imagePath = 'images/logos/' . $imageFile;
            $fullPath = public_path($imagePath);

            // Cek apakah file ada
            if (File::exists($fullPath)) {
                return $imagePath;
            }

            return null;
        };

        // Seed Coffee Items
        foreach ($coffeeItems as $item) {
            $imagePath = $getImagePath($item['name']);
            Menu::create(array_merge($item, [
                'category_id' => $coffeeCategory->id,
                'image' => $imagePath,
            ]));
        }

        // Seed Tea Items
        foreach ($teaItems as $item) {
            $imagePath = $getImagePath($item['name']);
            Menu::create(array_merge($item, [
                'category_id' => $teaCategory->id,
                'image' => $imagePath,
            ]));
        }

        // Seed Pastry Items
        foreach ($pastryItems as $item) {
            $imagePath = $getImagePath($item['name']);
            Menu::create(array_merge($item, [
                'category_id' => $pastryCategory->id,
                'image' => $imagePath,
            ]));
        }

        // Seed Dessert Items
        foreach ($dessertItems as $item) {
            $imagePath = $getImagePath($item['name']);
            Menu::create(array_merge($item, [
                'category_id' => $dessertCategory->id,
                'image' => $imagePath,
            ]));
        }
    }
}
