<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            ['title' => 'Experience the Future of Urban Mobility', 'image' => 'slides/slide1.jpg'],
            ['title' => 'Zero Emissions. Infinite Freedom.', 'image' => 'slides/slide2.jpg'],
            ['title' => 'Power Through Any Terrain', 'image' => 'slides/slide3.jpg'],
        ];

        foreach ($slides as $slide) {
            Slide::create($slide);
        }
    }
}
