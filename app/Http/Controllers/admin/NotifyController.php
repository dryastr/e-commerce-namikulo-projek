<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use App\Models\CatalogProduct;
use App\Models\Promo;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session as FacadesSession;
use Session;

class NotifyController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', 'success')->get();
        $notifications = [];
        foreach ($orders as $order) {
            $notifications[] = [
                'id' => $order->id,
                'message' => 'User ' . $order->user->name . 'telah membeli produk ' . $order->items->first()->product->name,
                'read' => Cookie::has('notification_' . $order->id) ? true : false,
            ];
        }

        $products = CatalogProduct::where('stock', '<', 10)->get();
        foreach ($products as $product) {
            $notifications[] = [
                'id' => $product->id,
                'message' => 'Produk ' . $product->name . 'stoknya sisa ' . $product->stock,
                'read' => Cookie::has('notification_' . $product->id) ? true : false,
            ];
        }

        $payments = Payment::get();
        foreach ($payments as $payment) {
            if ($payment->status == 'success') {
                $notifications[] = [
                    'id' => $payment->id,
                    'message' => 'Pembayaran order ' . $payment->order->order_number . 'berhasil',
                    'read' => Cookie::has('notification_' . $payment->id) ? true : false,
                ];
            } elseif ($payment->status == 'failed') {
                $notifications[] = [
                    'id' => $payment->id,
                    'message' => 'Pembayaran order ' . $payment->order->order_number . 'gagal',
                    'read' => Cookie::has('notification_' . $payment->id) ? true : false,
                ];
            }
        }

        $promos = Promo::get();
        foreach ($promos as $promo) {
            $notifications[] = [
                'id' => $promo->id,
                'message' => 'Promo produk ' . $promo->product->name . 'mulai dari ' . $promo->start_date . 'sampai ' . $promo->end_date,
                'read' => Cookie::has('notification_' . $promo->id) ? true : false,
            ];
        }

        if (request()->has('read')) {
            $id = request()->input('read');
            Cookie::queue('notification_' . $id, true, 60 * 24 * 365);
        }

        return view('admin.report.notify', compact('notifications'));
    }

    public function notifyread(Request $request)
    {
        $id = $request->input('read');
        Cookie::queue('notification_' . $id, true, 60 * 24 * 365);
        return redirect()->back();
    }
}
