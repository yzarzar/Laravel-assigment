<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'id' => 1,
                'name' => 'iPhone 14',
                'category_id' => rand(1, 5),
                'description' => 'The best iPhone ever',
                'price' => 999.99,
            ],
            [
                'id' => 2,
                'name' => 'Samsung TV',
                'category_id' => rand(1, 5),
                'description' => 'The best TV ever',
                'price' => 1999.99,
            ],
            [
                'id' => 3,
                'name' => 'MacBook Pro',
                'category_id' => rand(1, 5),
                'description' => 'The best laptop ever',
                'price' => 2999.99,
            ],
            [
                'id' => 4,
                'name' => 'Nike Shoes',
                'category_id' => rand(1, 5),
                'description' => 'The best shoes ever',
                'price' => 99.99,
            ],
            [
                'id' => 5,
                'name' => 'Playstation 5',
                'category_id' => rand(1, 5),
                'description' => 'The best console ever',
                'price' => 499.99,
            ],
        ];

        foreach ($products as $product) {
            Products::create($product);
        }
    }
}
