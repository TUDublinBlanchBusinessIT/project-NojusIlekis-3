<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Take the session cart and turn it into an Order + OrderItems.
     */
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Calculate total
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total'   => $total,
            'status'  => 'processing',
        ]);

        // Create order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['product_id'],
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        // Clear the cart
        session()->forget('cart');

        // Redirect to confirmation
        return redirect()->route('orders.show', $order)
                         ->with('success', 'Order placed successfully!');
    }

    /**
     * Show the order confirmation page.
     */
    public function show(Order $order)
    {
        // Ensure the auth user owns this order
        abort_unless($order->user_id === Auth::id(), 403);

        return view('orders.show', compact('order'));
    }

    /**
     * Display a listing of the user's orders.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->orderBy('created_at', 'desc')
                       ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Store or update the user's rating for this order.
     */
    public function rate(Request $request, Order $order)
    {
        // Validate the submitted star rating
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Ensure the logged-in user owns this order
        abort_unless($order->user_id === Auth::id(), 403);

        // Save the rating
        $order->update(['rating' => $data['rating']]);

        // Redirect back with a thank-you message
        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Thanks! You rated this order '.$data['rating'].'★');
    }
}

