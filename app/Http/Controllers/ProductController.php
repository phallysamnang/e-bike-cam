<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Slide;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function dashboard()
    {
        $products = Product::with('category')->get();
        $categories = Category::all();
        $slides_count = Slide::count();

        return view('dashboard', compact('products', 'categories', 'slides_count'));
    }
    public function index()
    {
        $products = Product::with('category')->latest()->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'image' => 'required|image',
        ]);

        $image = $request->file('image')->store('products', 'public');

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'battery_range' => $request->battery_range,
            'top_speed' => $request->top_speed,
            'stock' => $request->stock,
            'featured' => $request->has('featured'),
            'image' => $image,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product Created Successfully');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
        ]);

        if ($request->hasFile('image')) {

            Storage::disk('public')->delete($product->image);

            $image = $request->file('image')->store('products', 'public');

            $product->image = $image;
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'battery_range' => $request->battery_range,
            'top_speed' => $request->top_speed,
            'stock' => $request->stock,
            'featured' => $request->has('featured'),
        ]);

        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Product Updated Successfully');
    }

    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->image);

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product Deleted Successfully');
    }
}