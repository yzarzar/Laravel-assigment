<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categories;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalProducts = Products::count();
        $totalCategories = Categories::count();
        $totalUsers = User::count();
        $recentProducts = Products::latest()->take(5)->get();
        $recentCategories = Categories::latest()->take(5)->get();
        $activeProducts = Products::where('status', 1)->count();
        $inactiveProducts = Products::where('status', 0)->count();

        // Get products by category for pie chart
        $productsByCategory = Categories::withCount('products')
            ->orderBy('products_count', 'desc')
            ->take(5)
            ->get();

        // Get top 5 expensive products
        $topProducts = Products::orderBy('price', 'desc')
            ->take(5)
            ->get();

        // Monthly products count
        $monthlyProducts = Products::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        // Fill in missing months with 0
        $chartData = array_replace(array_fill(1, 12, 0), $monthlyProducts);

        return view('home', compact(
            'totalProducts',
            'totalCategories',
            'totalUsers',
            'recentProducts',
            'recentCategories',
            'activeProducts',
            'inactiveProducts',
            'productsByCategory',
            'topProducts',
            'chartData'
        ));
    }
}
