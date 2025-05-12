<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function processCheckout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:bank,ewallet',
            'payment_type' => 'required',
            'proof_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $validPaymentTypes = [
            'bank' => ['bca', 'bni', 'bri', 'mandiri'],
            'ewallet' => ['dana', 'shopee']
        ];

        if (!in_array($request->payment_type, $validPaymentTypes[$request->payment_method])) {
            return back()->with('error', 'Jenis pembayaran tidak valid');
        }

        $user = Auth::user();
        $cart = Cart::with('items.product')->where('user_id', $user->id)->first();

        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . Str::upper(Str::random(10)),
            'total_amount' => $cart->total,
            'status' => 'pending'
        ]);

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
        }

        $imagePath = $request->file('proof_image')->store('payment_proofs', 'public');

        Payment::create([
            'order_id' => $order->id,
            'payment_method' => $request->payment_method,
            'payment_type' => $request->payment_type,
            'proof_image' => $imagePath,
            'status' => 'pending'
        ]);

        $cart->items()->delete();

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Pesanan berhasil dibuat. Menunggu konfirmasi pembayaran.');
    }

    public function showOrder()
    {
        $order = Order::with(['payment', 'items.product'])
            ->where('user_id', auth()->id())
            ->latest()
            ->firstOrFail();

        return view('user.cart.show', compact('order'));
    }
}
