<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\CatalogProduct;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = CatalogProduct::whereHas('category', function ($q) {
            $q->where('name', 'wisata');
        });

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $latestProducts = $query->latest()->get();

        return view('landing_page', compact('latestProducts'));
    }

    public function show($id)
    {
        $product = CatalogProduct::findOrFail($id);
        return view('user.products.detail', compact('product'));
    }

    public function news()
    {
        $latestNews = CatalogProduct::whereHas('category', function ($query) {
            $query->where('name', 'berita');
        })->latest()->get();

        return view('user.news.index', compact('latestNews'));
    }

    public function newsDetail($id)
    {
        $product = CatalogProduct::findOrFail($id);
        return view('user.news.detail', compact('product'));
    }

    public function kuliner()
    {
        $latestKuliners = CatalogProduct::whereHas('category', function ($query) {
            $query->where('name', 'kuliner');
        })->latest()->get();

        return view('user.kuliner.index', compact('latestKuliners'));
    }

    public function kulinerDetail($id)
    {
        $product = CatalogProduct::findOrFail($id);
        return view('user.kuliner.detail', compact('product'));
    }

    public function about()
    {
        return view('user.about.index');
    }
}
