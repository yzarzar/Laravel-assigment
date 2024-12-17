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
                'name' => 'Product 1',
                'description' => 'Description 1',
                'price' => 10.99,
            ],
            [
                'id' => 2,
                'name' => 'Product 2',
                'description' => 'Description 2',
                'price' => 19.99,
            ],
            [
                'id' => 3,
                'name' => 'Product 3',
                'description' => 'Description 3',
                'price' => 29.99,
            ],
            [
                'id' => 4,
                'name' => 'Product 4',
                'description' => 'Description 4',
                'price' => 39.99,
            ],
            [
                'id' => 5,
                'name' => 'Product 5',
                'description' => 'Description 5',
                'price' => 49.99,
            ],
        ];

        foreach ($products as $product) {
            Products::create($product);
        }
    }
}
