<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $slides = Slide::latest()->get();

        $categories = Category::latest()->get();

        $products = Product::with('category')
                    ->latest()
                    ->take(8)
                    ->get();

        return view('front', compact(
            'slides',
            'categories',
            'products'
        ));
    }

    public function show(Product $product)
    {
        $product->load('category');

        $related = Product::with('category')
                    ->where('category_id', $product->category_id)
                    ->where('id', '!=', $product->id)
                    ->latest()
                    ->take(4)
                    ->get();

        return view('product-show', compact('product', 'related'));
    }

    public function category(Category $category)
    {
        $products = Product::with('category')
                    ->where('category_id', $category->id)
                    ->latest()
                    ->paginate(12);

        $categories = Category::latest()->get();

        $slides = Slide::latest()->get();

        return view('category', compact('category', 'products', 'categories', 'slides'));
    }
}