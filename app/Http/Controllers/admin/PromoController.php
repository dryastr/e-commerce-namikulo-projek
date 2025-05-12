<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CatalogProduct;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        $products = CatalogProduct::with('promos')->get();

        return view('admin.promo.index', compact('products'));
    }

    public function store(Request $request)
    {
        $productId = $request->input('product_id');
        $product = CatalogProduct::find($productId);

        $promo = new Promo();
        $promo->product_id = $product->id;
        $promo->discount = $request->input('discount');
        $promo->start_date = $request->input('start_date');
        $promo->end_date = $request->input('end_date');
        $promo->save();

        return redirect()->back()->with('success', 'Promo berhasil ditambahkan');
    }

    public function update(Request $request, $promoId)
    {
        $promo = Promo::find($promoId);
        $promo->discount = $request->input('discount');
        $promo->start_date = $request->input('start_date');
        $promo->end_date = $request->input('end_date');
        $promo->save();

        return redirect()->back()->with('success', 'Promo berhasil diupdate');
    }
}
