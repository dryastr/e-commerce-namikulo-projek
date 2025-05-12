<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CatalogProduct;
use App\Models\ProductRating;
use Illuminate\Http\Request;

class UserCategoriesController extends Controller
{
    public function show($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $products = CatalogProduct::where('category_id', $categoryId)->get();

        return view('user.products.by_category', compact('category', 'products'));
    }

    public function productDetail($productId)
    {
        $product = CatalogProduct::with('category', 'ratings')->findOrFail($productId);
        return view('user.products.detail', compact('product'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        $products = CatalogProduct::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        return view('user.products.search_results', compact('products', 'query'));
    }
}
