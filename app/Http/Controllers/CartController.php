<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Display cart contents
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Add a product to the cart
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        $id = $product->id;
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'product_id' => $id,
                'name'       => $product->name,
                'price'      => $product->price,
                'quantity'   => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')
                         ->with('success', 'Product added to cart.');
    }

    // Update quantity of a cart item
    public function update(Request $request, Product $product)
    {
        $quantity = $request->validate([
            'quantity' => 'required|integer|min:1'
        ])['quantity'];

        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

    // Remove an item from the cart
    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')
                         ->with('success', 'Product removed from cart.');
    }
}
