<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Nike Air Max 270',
            'slug' => 'nike-air-max-270',
            'category_id' => 1,
            'price' => 1800000,
            'sale_price' => 800000,
            'stock' => 15,
            'image' => 'nike270.jpg',
            'sku' => 'NA270-001',
            'description' => 'Sepatu running ringan dan nyaman.',
            'is_active' => true
        ]);

        Product::create([
            'name' => 'Adidas Ultraboost',
            'slug' => 'adidas-ultraboost',
            'category_id' => 1,
            'price' => 2200000,
            'sale_price' => 2000000,
            'stock' => 10,
            'image' => 'ultraboost.jpg',
            'sku' => 'AU-002',
            'description' => 'Sepatu lari premium.',
            'is_active' => true
        ]);

        Product::create([
            'name' => 'Converse Run Star',
            'slug' => 'converse-run-star',
            'category_id' => 3,
            'price' => 2200000,
            'sale_price' => 2000000,
            'stock' => 10,
            'image' => 'sunstar.jpg',
            'sku' => 'CRS-003',
            'description' => 'Sepatu lari premium.',
            'is_active' => true
        ]);

        Product::create([
            'name' => 'Compass Gazelle',
            'slug' => 'compas-gazelle',
            'category_id' => 3,
            'price' => 750000,
            'sale_price' => 700000,
            'stock' => 10,
            'image' => 'sunstar.jpg',
            'sku' => 'CMS-004',
            'description' => 'Sepatu lokal permium.',
            'is_active' => true
        ]);

        // Product::factory(20)->create();
    }
}
