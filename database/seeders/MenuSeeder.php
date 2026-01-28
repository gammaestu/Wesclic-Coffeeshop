<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coffeeCategory = Category::where('name', 'Coffee')->first();
        $teaCategory = Category::where('name', 'Tea')->first();
        $pastryCategory = Category::where('name', 'Pastry')->first();
        $dessertCategory = Category::where('name', 'Dessert')->first();

        // Coffee Items
        $coffeeItems = [
            [
                'name' => 'Espresso',
                'description' => 'Rich and bold Italian espresso, the perfect foundation for any coffee drink.',
                'price' => 3.50,
                'stock' => 50,
                'image' => 'images/logos/menu-espresso.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Americano',
                'description' => 'Smooth espresso with hot water, creating a rich and flavorful cup.',
                'price' => 4.00,
                'stock' => 45,
                'image' => 'images/logos/menu-americano.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Cappuccino',
                'description' => 'Perfect balance of espresso, steamed milk, and velvety foam.',
                'price' => 4.50,
                'stock' => 60,
                'image' => 'images/logos/menu-cappuccino.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Latte',
                'description' => 'Smooth espresso with steamed milk, topped with delicate foam art.',
                'price' => 4.75,
                'stock' => 55,
                'image' => 'images/logos/menu-latte.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Mocha',
                'description' => 'Indulgent blend of espresso, rich chocolate, and steamed milk.',
                'price' => 5.00,
                'stock' => 50,
                'image' => 'images/logos/menu-mocha.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Macchiato',
                'description' => 'Bold espresso with a dollop of foam, for the true coffee connoisseur.',
                'price' => 4.25,
                'stock' => 40,
                'image' => 'images/logos/menu-macchiato.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Flat White',
                'description' => 'Double espresso with microfoam, creating a velvety smooth texture.',
                'price' => 4.50,
                'stock' => 45,
                'image' => 'images/logos/menu-flat-white.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Cold Brew',
                'description' => 'Smooth, refreshing cold-brewed coffee, steeped for 24 hours.',
                'price' => 4.75,
                'stock' => 35,
                'image' => 'images/logos/menu-cold-brew.svg',
                'status' => 'tersedia',
            ],
        ];

        // Tea Items
        $teaItems = [
            [
                'name' => 'Green Tea',
                'description' => 'Fresh and aromatic green tea, packed with antioxidants.',
                'price' => 3.50,
                'stock' => 40,
                'image' => 'images/logos/menu-green-tea.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Black Tea',
                'description' => 'Classic English breakfast tea, robust and full-bodied.',
                'price' => 3.50,
                'stock' => 40,
                'image' => 'images/logos/menu-black-tea.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Chai Latte',
                'description' => 'Spiced tea with steamed milk, warm and comforting.',
                'price' => 4.50,
                'stock' => 50,
                'image' => 'images/logos/menu-chai-latte.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Earl Grey',
                'description' => 'Bergamot-infused black tea, elegant and refined.',
                'price' => 3.75,
                'stock' => 35,
                'image' => 'images/logos/menu-earl-grey.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Herbal Tea',
                'description' => 'Selection of calming herbal blends, caffeine-free.',
                'price' => 3.50,
                'stock' => 30,
                'image' => 'images/logos/menu-herbal-tea.svg',
                'status' => 'tersedia',
            ],
        ];

        // Pastry Items
        $pastryItems = [
            [
                'name' => 'Croissant',
                'description' => 'Buttery and flaky French pastry, baked fresh daily.',
                'price' => 3.00,
                'stock' => 25,
                'image' => 'images/logos/menu-croissant.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Chocolate Chip Cookie',
                'description' => 'Warm, gooey chocolate chip cookie, made with premium chocolate.',
                'price' => 2.50,
                'stock' => 30,
                'image' => 'images/logos/menu-cookie.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Blueberry Muffin',
                'description' => 'Freshly baked with real blueberries, moist and delicious.',
                'price' => 3.25,
                'stock' => 20,
                'image' => 'images/logos/menu-muffin.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Cinnamon Roll',
                'description' => 'Sweet cinnamon swirl with cream cheese glaze.',
                'price' => 3.50,
                'stock' => 18,
                'image' => 'images/logos/menu-cinnamon-roll.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Almond Croissant',
                'description' => 'Buttery croissant with rich almond filling, topped with sliced almonds.',
                'price' => 3.75,
                'stock' => 15,
                'image' => 'images/logos/menu-almond-croissant.svg',
                'status' => 'tersedia',
            ],
        ];

        // Dessert Items
        $dessertItems = [
            [
                'name' => 'Tiramisu',
                'description' => 'Classic Italian coffee dessert, layers of mascarpone and espresso-soaked ladyfingers.',
                'price' => 5.50,
                'stock' => 12,
                'image' => 'images/logos/menu-tiramisu.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Cheesecake',
                'description' => 'Creamy New York style cheesecake with graham cracker crust.',
                'price' => 5.00,
                'stock' => 10,
                'image' => 'images/logos/menu-cheesecake.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Rich and decadent chocolate cake with chocolate frosting.',
                'price' => 4.75,
                'stock' => 8,
                'image' => 'images/logos/menu-chocolate-cake.svg',
                'status' => 'tersedia',
            ],
            [
                'name' => 'Apple Pie',
                'description' => 'Homemade with fresh apples, warm cinnamon, and flaky crust.',
                'price' => 4.50,
                'stock' => 10,
                'image' => 'images/logos/menu-apple-pie.svg',
                'status' => 'tersedia',
            ],
        ];

        // Insert Coffee Items
        foreach ($coffeeItems as $item) {
            Menu::create(array_merge($item, ['category_id' => $coffeeCategory->id]));
        }

        // Insert Tea Items
        foreach ($teaItems as $item) {
            Menu::create(array_merge($item, ['category_id' => $teaCategory->id]));
        }

        // Insert Pastry Items
        foreach ($pastryItems as $item) {
            Menu::create(array_merge($item, ['category_id' => $pastryCategory->id]));
        }

        // Insert Dessert Items
        foreach ($dessertItems as $item) {
            Menu::create(array_merge($item, ['category_id' => $dessertCategory->id]));
        }
    }
}