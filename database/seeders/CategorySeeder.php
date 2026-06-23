<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'City Commuter'],
            ['name' => 'Mountain Explorer'],
            ['name' => 'Performance Racing'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
