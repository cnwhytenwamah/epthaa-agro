<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Booking;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        // Statistics
        $totalOrders = Order::count();
        $totalBookings = Booking::count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');
        $pendingOrders = Order::where('order_status', 'pending')->count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        
        // Recent orders
        $recentOrders = Order::with('items')->orderBy('created_at', 'desc')->take(5)->get();
        
        // Recent bookings
        $recentBookings = Booking::with('service')->orderBy('created_at', 'desc')->take(5)->get();
        
        // Monthly revenue chart data
        $monthlyRevenue = Order::where('payment_status', 'paid')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total) as revenue'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        // Low stock products
        $lowStockProducts = Product::where('stock_quantity', '<', 10)->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalBookings',
            'totalRevenue',
            'pendingOrders',
            'pendingBookings',
            'recentOrders',
            'recentBookings',
            'monthlyRevenue',
            'lowStockProducts'
        ));
    }
}