<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            ['name' => 'Product A', 'price' => 19.99, 'description' => 'Description for Product A'],
            ['name' => 'Product B', 'price' => 29.99, 'description' => 'Description for Product B'],
            ['name' => 'Product C', 'price' => 39.99, 'description' => 'Description for Product C']
        ]);
        //
    }
}
