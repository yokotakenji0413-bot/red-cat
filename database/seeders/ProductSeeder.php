<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => '春野菜セット',
            'price' => 1200,
            'description' => '春の新鮮な野菜セットです',
            'season' => json_encode(['春']),
            'image' => null,
        ]);

        Product::create([
            'name' => '夏フルーツ盛り',
            'price' => 1800,
            'description' => '夏にぴったりのフルーツです',
            'season' => json_encode(['夏']),
            'image' => null,
        ]);

        Product::create([
            'name' => '秋の味覚セット',
            'price' => 1500,
            'description' => '秋の旬の食材を集めました',
            'season' => json_encode(['秋']),
            'image' => null,
        ]);

        Product::create([
            'name' => '冬あったか鍋セット',
            'price' => 2000,
            'description' => '冬にぴったりの鍋セットです',
            'season' => json_encode(['冬']),
            'image' => null,
        ]);
    }
}
