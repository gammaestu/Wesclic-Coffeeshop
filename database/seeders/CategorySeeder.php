<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Coffee',
                'description' => 'Premium coffee selections from around the world, roasted to perfection.',
                'status' => 'aktif',
            ],
            [
                'name' => 'Tea',
                'description' => 'Aromatic teas and herbal blends for every taste preference.',
                'status' => 'aktif',
            ],
            [
                'name' => 'Pastry',
                'description' => 'Freshly baked pastries and breads made daily with premium ingredients.',
                'status' => 'aktif',
            ],
            [
                'name' => 'Dessert',
                'description' => 'Indulgent desserts and sweet treats to satisfy your cravings.',
                'status' => 'aktif',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}