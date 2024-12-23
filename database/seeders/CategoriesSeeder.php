<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'Electronics',
            ],
            [
                'id' => 2,
                'name' => 'Home & Kitchen',
            ],
            [
                'id' => 3,
                'name' => 'Toys & Games',
            ],
            [
                'id' => 4,
                'name' => 'Clothing, Shoes & Jewelry',
            ],
            [
                'id' => 5,
                'name' => 'Beauty & Personal Care',
            ],
        ];

        foreach ($categories as $category) {
            Categories::create($category);
        }
    }
}
