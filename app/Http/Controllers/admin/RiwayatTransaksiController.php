<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class RiwayatTransaksiController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'payment')->get();

        return view('admin.history_user.index', compact('orders'));
    }
}
