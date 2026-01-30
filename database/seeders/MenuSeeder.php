<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Seeder;

/**
 * Seeder menu dengan harga Rupiah (IDR) dan gambar HD dari Unsplash.
 * Semua image menggunakan URL Unsplash (w=1200) — tidak perlu upload manual.
 */
class MenuSeeder extends Seeder
{
    /** URL dasar Unsplash HD (lebar 1200px, kualitas 85, format PNG bila didukung). */
    private const UNSPLASH_HD = 'https://images.unsplash.com/photo-%s?w=1200&q=85&fm=png';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coffeeCategory = Category::where('name', 'Coffee')->first();
        $teaCategory = Category::where('name', 'Tea')->first();
        $pastryCategory = Category::where('name', 'Pastry')->first();
        $dessertCategory = Category::where('name', 'Dessert')->first();

        // Coffee Items — gambar HD Unsplash (espresso, latte, cappuccino, cold brew, dll.)
        $coffeeItems = [
            ['name' => 'Espresso', 'description' => 'Rich and bold Italian espresso, the perfect foundation for any coffee drink.', 'price' => 25000, 'stock' => 50, 'image' => self::url('1445077100181-a01b234cc32f'), 'status' => 'tersedia'],
            ['name' => 'Americano', 'description' => 'Smooth espresso with hot water, creating a rich and flavorful cup.', 'price' => 28000, 'stock' => 45, 'image' => self::url('1514432324607-a09d9b4aefdd'), 'status' => 'tersedia'],
            ['name' => 'Cappuccino', 'description' => 'Perfect balance of espresso, steamed milk, and velvety foam.', 'price' => 32000, 'stock' => 60, 'image' => self::url('1572442388796-011668296f3d'), 'status' => 'tersedia'],
            ['name' => 'Latte', 'description' => 'Smooth espresso with steamed milk, topped with delicate foam art.', 'price' => 35000, 'stock' => 55, 'image' => self::url('1561882468-9110e03e0f78'), 'status' => 'tersedia'],
            ['name' => 'Mocha', 'description' => 'Indulgent blend of espresso, rich chocolate, and steamed milk.', 'price' => 38000, 'stock' => 50, 'image' => self::url('1542990253-191691f2d0c'), 'status' => 'tersedia'],
            ['name' => 'Macchiato', 'description' => 'Bold espresso with a dollop of foam, for the true coffee connoisseur.', 'price' => 30000, 'stock' => 40, 'image' => self::url('1495474472287-4d71bcdd2085'), 'status' => 'tersedia'],
            ['name' => 'Flat White', 'description' => 'Double espresso with microfoam, creating a velvety smooth texture.', 'price' => 32000, 'stock' => 45, 'image' => self::url('1509042239860-f550ce710b93'), 'status' => 'tersedia'],
            ['name' => 'Cold Brew', 'description' => 'Smooth, refreshing cold-brewed coffee, steeped for 24 hours.', 'price' => 35000, 'stock' => 35, 'image' => self::url('1517701550924-334cd8c915f6'), 'status' => 'tersedia'],
        ];

        // Tea Items — gambar HD teh
        $teaItems = [
            ['name' => 'Green Tea', 'description' => 'Fresh and aromatic green tea, packed with antioxidants.', 'price' => 25000, 'stock' => 40, 'image' => self::url('1564890369478-c89ca6d9cde9'), 'status' => 'tersedia'],
            ['name' => 'Black Tea', 'description' => 'Classic English breakfast tea, robust and full-bodied.', 'price' => 25000, 'stock' => 40, 'image' => self::url('1576092768241-dec23141fc3d'), 'status' => 'tersedia'],
            ['name' => 'Chai Latte', 'description' => 'Spiced tea with steamed milk, warm and comforting.', 'price' => 32000, 'stock' => 50, 'image' => self::url('1544787219-7f47ccb76574'), 'status' => 'tersedia'],
            ['name' => 'Earl Grey', 'description' => 'Bergamot-infused black tea, elegant and refined.', 'price' => 26000, 'stock' => 35, 'image' => self::url('1571934812371-364bc2442b20'), 'status' => 'tersedia'],
            ['name' => 'Herbal Tea', 'description' => 'Selection of calming herbal blends, caffeine-free.', 'price' => 25000, 'stock' => 30, 'image' => self::url('1564890369478-c89ca6d9cde9'), 'status' => 'tersedia'],
        ];

        // Pastry Items — gambar HD pastry
        $pastryItems = [
            ['name' => 'Croissant', 'description' => 'Buttery and flaky French pastry, baked fresh daily.', 'price' => 22000, 'stock' => 25, 'image' => self::url('1555507036-ab1f4038808a'), 'status' => 'tersedia'],
            ['name' => 'Chocolate Chip Cookie', 'description' => 'Warm, gooey chocolate chip cookie, made with premium chocolate.', 'price' => 18000, 'stock' => 30, 'image' => self::url('1558961363-fa8fdf82db35'), 'status' => 'tersedia'],
            ['name' => 'Blueberry Muffin', 'description' => 'Freshly baked with real blueberries, moist and delicious.', 'price' => 24000, 'stock' => 20, 'image' => self::url('1607958996333-c739310427e8'), 'status' => 'tersedia'],
            ['name' => 'Cinnamon Roll', 'description' => 'Sweet cinnamon swirl with cream cheese glaze.', 'price' => 28000, 'stock' => 18, 'image' => self::url('1551024506-0bccbef8286d'), 'status' => 'tersedia'],
            ['name' => 'Almond Croissant', 'description' => 'Buttery croissant with rich almond filling, topped with sliced almonds.', 'price' => 28000, 'stock' => 15, 'image' => self::url('1555507036-ab1f4038808a'), 'status' => 'tersedia'],
        ];

        // Dessert Items — gambar HD dessert
        $dessertItems = [
            ['name' => 'Tiramisu', 'description' => 'Classic Italian coffee dessert, layers of mascarpone and espresso-soaked ladyfingers.', 'price' => 42000, 'stock' => 12, 'image' => self::url('1571877228620-9c9b377eba35'), 'status' => 'tersedia'],
            ['name' => 'Cheesecake', 'description' => 'Creamy New York style cheesecake with graham cracker crust.', 'price' => 38000, 'stock' => 10, 'image' => self::url('1533134242443-d4dd215c2baa'), 'status' => 'tersedia'],
            ['name' => 'Chocolate Cake', 'description' => 'Rich and decadent chocolate cake with chocolate frosting.', 'price' => 35000, 'stock' => 8, 'image' => self::url('1578985545062-69928b1d9587'), 'status' => 'tersedia'],
            ['name' => 'Apple Pie', 'description' => 'Homemade with fresh apples, warm cinnamon, and flaky crust.', 'price' => 32000, 'stock' => 10, 'image' => self::url('1562007908-17c67e878c88'), 'status' => 'tersedia'],
        ];

        foreach ($coffeeItems as $item) {
            Menu::create(array_merge($item, ['category_id' => $coffeeCategory->id]));
        }
        foreach ($teaItems as $item) {
            Menu::create(array_merge($item, ['category_id' => $teaCategory->id]));
        }
        foreach ($pastryItems as $item) {
            Menu::create(array_merge($item, ['category_id' => $pastryCategory->id]));
        }
        foreach ($dessertItems as $item) {
            Menu::create(array_merge($item, ['category_id' => $dessertCategory->id]));
        }
    }

    /** URL gambar HD Unsplash (w=1200, q=85). */
    private static function url(string $photoId): string
    {
        return sprintf(self::UNSPLASH_HD, $photoId);
    }
}
