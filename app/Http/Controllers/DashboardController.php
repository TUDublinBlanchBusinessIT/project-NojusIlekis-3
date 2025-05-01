<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Totals
        $totalOrders     = Order::count();
        $pendingOrders   = Order::where('status','processing')->count();
        $totalProducts   = Product::count();
        $totalCategories = Category::count();
        $totalSales      = Order::sum('total');

        // Recent 5 orders
        $recentOrders = Order::with('items')
                             ->orderBy('created_at','desc')
                             ->take(5)
                             ->get();

        return view('dashboard', compact(
            'totalOrders','pendingOrders',
            'totalProducts','totalCategories',
            'totalSales','recentOrders'
        ));
    }
}

