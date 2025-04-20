<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show all categories
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Show form to create a category
    public function create()
    {
        return view('categories.create');
    }

    // Handle form submission and save
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($data);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category created.');
    }

    // (You can leave show/edit/update/destroy empty for now)
    public function show($id) { /* … */ }
    public function edit($id) { /* … */ }
    public function update(Request $request, $id) { /* … */ }
    public function destroy($id) { /* … */ }
}

