<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1,
                'name' => 'Volt City S1',
                'price' => 2499.00,
                'description' => 'Sleek urban commuter with integrated lights, fenders, and a step-through frame. Perfect for navigating city streets with effortless style.',
                'image' => 'products/city-s1.jpg',
                'battery_range' => '80 KM',
                'top_speed' => '32 KM/H',
                'stock' => 15,
                'featured' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Volt City X2',
                'price' => 3299.00,
                'description' => 'Premium city e-bike with dual battery system, carbon belt drive, and smart display. The ultimate urban commuter.',
                'image' => 'products/city-x2.jpg',
                'battery_range' => '160 KM',
                'top_speed' => '35 KM/H',
                'stock' => 8,
                'featured' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Volt Urban Lite',
                'price' => 1899.00,
                'description' => 'Lightweight aluminum frame city bike with hidden battery. Ideal for short commutes and casual riding.',
                'image' => 'products/urban-lite.jpg',
                'battery_range' => '60 KM',
                'top_speed' => '28 KM/H',
                'stock' => 25,
                'featured' => false,
            ],
            [
                'category_id' => 2,
                'name' => 'Volt Trail M5',
                'price' => 4199.00,
                'description' => 'Full suspension mountain e-bike with 150mm travel, 750W motor, and aggressive trail geometry. Conquer any trail with confidence.',
                'image' => 'products/trail-m5.jpg',
                'battery_range' => '90 KM',
                'top_speed' => '35 KM/H',
                'stock' => 6,
                'featured' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Volt Enduro X3',
                'price' => 5299.00,
                'description' => 'Enduro-ready electric mountain bike with carbon frame, 180mm travel, and powerful mid-drive motor for the most demanding descents.',
                'image' => 'products/enduro-x3.jpg',
                'battery_range' => '70 KM',
                'top_speed' => '35 KM/H',
                'stock' => 3,
                'featured' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Volt Trail Explorer',
                'price' => 3599.00,
                'description' => 'Versatile trail e-bike with balanced geometry and reliable components. Great for all-day adventures on varied terrain.',
                'image' => 'products/trail-explorer.jpg',
                'battery_range' => '100 KM',
                'top_speed' => '32 KM/H',
                'stock' => 12,
                'featured' => false,
            ],
            [
                'category_id' => 3,
                'name' => 'Volt Racer R1',
                'price' => 6999.00,
                'description' => 'Track-inspired electric speed bike with aerodynamic carbon frame, 1000W motor, and racing geometry. Built for speed enthusiasts.',
                'image' => 'products/racer-r1.jpg',
                'battery_range' => '65 KM',
                'top_speed' => '55 KM/H',
                'stock' => 4,
                'featured' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Volt Sport P8',
                'price' => 5499.00,
                'description' => 'High-performance road e-bike with integrated downtube battery, electronic shifting, and carbon wheels. Dominate the asphalt.',
                'image' => 'products/sport-p8.jpg',
                'battery_range' => '85 KM',
                'top_speed' => '50 KM/H',
                'stock' => 5,
                'featured' => false,
            ],
            [
                'category_id' => 3,
                'name' => 'Volt Sprint Pro',
                'price' => 7999.00,
                'description' => 'Professional-grade electric road bike used by competitive cyclists. Features ultralight carbon construction and race-tuned motor.',
                'image' => 'products/sprint-pro.jpg',
                'battery_range' => '75 KM',
                'top_speed' => '60 KM/H',
                'stock' => 2,
                'featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
