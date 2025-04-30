<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Load all products along with their category
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        // Load categories for dropdown
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'active'      => 'sometimes|boolean',
        ]);

        // Checkbox unchecked → not present → default to false
        $data['active'] = $request->has('active');

        Product::create($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product created.');
    }

    public function show($id)
    {
        //
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'active'      => 'sometimes|boolean',
        ]);

        // Handle the checkbox
        $data['active'] = $request->has('active');

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted.');
    }
}

