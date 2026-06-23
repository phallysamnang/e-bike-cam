<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::latest()->get();

        return view('slides.index', compact('slides'));
    }

    public function create()
    {
        return view('slides.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image',
        ]);

        $image = $request->file('image')->store('slides', 'public');

        Slide::create([
            'title' => $request->title,
            'image' => $image,
        ]);

        return redirect()->route('slides.index')
            ->with('success', 'Slide Created Successfully');
    }

    public function edit(Slide $slide)
    {
        return view('slides.edit', compact('slide'));
    }

    public function update(Request $request, Slide $slide)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {

            Storage::disk('public')->delete($slide->image);

            $image = $request->file('image')->store('slides', 'public');

            $slide->image = $image;
        }

        $slide->title = $request->title;

        $slide->save();

        return redirect()->route('slides.index')
            ->with('success', 'Slide Updated Successfully');
    }

    public function destroy($id)
    {
        $slide = Slide::findOrFail($id);

        Storage::disk('public')->delete($slide->image);

        $slide->delete();

        return redirect()->route('slides.index')
            ->with('success', 'Slide deleted successfully');
    }
    
}