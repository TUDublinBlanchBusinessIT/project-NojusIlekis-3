<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

        // ── Chart data: orders per day over last 7 days ──
        $raw = Order::selectRaw("DATE(created_at) as date, COUNT(*) as cnt")
                    ->where('created_at', '>=', now()->subDays(6)->startOfDay())
                    ->groupBy('date')
                    ->orderBy('date')
                    ->pluck('cnt','date')
                    ->toArray();

        $chartLabels = [];
        $chartData   = [];

        for ($i = 6; $i >= 0; $i--) {
            $date       = now()->subDays($i)->toDateString();
            $chartLabels[] = now()->subDays($i)->format('M j');
            $chartData[]   = $raw[$date] ?? 0;
        }

        return view('dashboard', compact(
            'totalOrders','pendingOrders',
            'totalProducts','totalCategories',
            'totalSales','recentOrders',
            'chartLabels','chartData'
        ));
    }
}


