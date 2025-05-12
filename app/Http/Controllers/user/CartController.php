<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CatalogProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getOrCreateCart();
        return view('user.cart.index', compact('cart'));
    }

    public function add(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $product = CatalogProduct::findOrFail($productId);
        $cart = $this->getOrCreateCart();

        $existingItem = $cart->items()->where('product_id', $productId)->first();

        if ($existingItem) {
            $existingItem->update([
                'quantity' => $existingItem->quantity + $request->quantity
            ]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function updateQuantity(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $item = CartItem::with('product')->findOrFail($itemId);

        // Validasi stok
        if ($request->quantity > $item->product->stock) {
            return response()->json([
                'success' => false,
                'message' => 'Stok tidak mencukupi'
            ], 400);
        }

        $item->update(['quantity' => $request->quantity]);

        $cart = $this->getOrCreateCart();

        return response()->json([
            'success' => true,
            'item_subtotal' => number_format($item->product->price * $item->quantity, 2),
            'cart_total' => number_format($cart->total, 2)
        ]);
    }

    public function removeItem($itemId)
    {
        $item = CartItem::findOrFail($itemId);
        $item->delete();

        $cart = $this->getOrCreateCart();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang');
    }

    protected function getOrCreateCart()
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        return $cart->load('items.product');
    }
}
