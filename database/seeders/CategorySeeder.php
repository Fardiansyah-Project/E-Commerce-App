<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Running', 'Casual', 'Basket', 'Boots', 'Sandals'];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat
            ]);
        }
    }
}
