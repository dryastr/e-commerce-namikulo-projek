<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\ProductRating;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:catalog_products,id',
            'rating' => 'required|integer|between:1,5',
            'review' => 'nullable|string|max:500'
        ]);

        $order = Order::where('user_id', Auth::id())
            ->where('id', $request->order_id)
            ->firstOrFail();

        if (!$order->items()->where('product_id', $request->product_id)->exists()) {
            return back()->with('error', 'Produk tidak ditemukan di pesanan ini');
        }

        if (ProductRating::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->where('order_id', $request->order_id)
            ->exists()
        ) {
            return back()->with('error', 'Anda sudah memberikan rating untuk produk ini');
        }

        ProductRating::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'review' => $request->review
        ]);

        return back()->with('success', 'Terima kasih atas rating Anda!');
    }
}
