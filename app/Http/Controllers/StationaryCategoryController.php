<?php

namespace App\Http\Controllers;

use App\Models\StationaryCategory;
use Illuminate\Http\Request;

class StationaryCategoryController extends Controller
{
    
    public function index()
    {
        $categories = StationaryCategory::all();
        return view('stationary-categories.index', compact('categories'));
    }

   
    public function create()
    {
        return view('stationary-categories.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:100|unique:stationary_category,category_name',
        ]);

        StationaryCategory::create($request->all());

        return redirect()->route('stationary-categories.index')
                        ->with('success', 'Stationary category created successfully.');
    }

   
    public function show($id)
    {
        $category = StationaryCategory::findOrFail($id);
        return view('stationary-categories.show', compact('category'));
    }

   
    public function edit($id)
    {
        $category = StationaryCategory::findOrFail($id);
        return view('stationary-categories.edit', compact('category'));
    }

   
    public function update(Request $request, $id)
    {
        $category = StationaryCategory::findOrFail($id);

        $request->validate([
            'category_name' => 'required|string|max:100|unique:stationary_category,category_name,'.$id.',category_id',
        ]);

        $category->update($request->all());

        return redirect()->route('stationary-categories.index')
                        ->with('success', 'Stationary category updated successfully');
    }

   
    public function destroy($id)
    {
        $category = StationaryCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('stationary-categories.index')
                        ->with('success', 'Stationary category deleted successfully');
    }
}