<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'payment', 'items')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('user', 'payment', 'items')->find($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();
        return redirect()->back()->with('success', 'Status pemesanan berhasil diupdate');
    }

    public function confirmPayment($id)
    {
        $order = Payment::find($id);
        $order->status = 'completed';
        $order->save();
        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi');
    }

    public function completeOrder($id)
    {
        $order = Order::find($id);
        $order->status = 'completed';
        $order->save();
        return redirect()->back()->with('success', 'Pemesanan berhasil diselesaikan');
    }
}
