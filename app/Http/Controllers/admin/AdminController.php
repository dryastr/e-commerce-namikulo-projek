<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CatalogProduct;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $totalProducts = CatalogProduct::sum('stock');

        $newOrders = Order::where('status', 'pending')->count();

        $latestCustomers = User::count();

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $salesData = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->selectRaw('WEEK(created_at, 1) as week, SUM(total_amount) as total')
            ->groupBy('week')
            ->orderBy('week')
            ->get();

        return view('admin.dashboard', compact('totalProducts', 'newOrders', 'latestCustomers', 'salesData'));
    }
}
