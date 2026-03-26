<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'バナナ',
            'price' => 1200,
            'description' => '甘くて美味しいバナナです',
            'season' => json_encode(['春']),
            'image' => 'products/banana.png',
        ]);

        Product::create([
            'name' => 'オレンジ',
            'price' => 1800,
            'description' => 'ジューシーなオレンジです',
            'season' => json_encode(['夏']),
            'image' => 'products/orange.png',
        ]);

        Product::create([
            'name' => 'ぶどう',
            'price' => 1500,
            'description' => '甘いぶどうです',
            'season' => json_encode(['秋']),
            'image' => 'products/grapes.png',
        ]);

        Product::create([
            'name' => 'メロン',
            'price' => 2000,
            'description' => '高級なメロンです',
            'season' => json_encode(['冬']),
            'image' => 'products/melon.png',
        ]);
    }
}
