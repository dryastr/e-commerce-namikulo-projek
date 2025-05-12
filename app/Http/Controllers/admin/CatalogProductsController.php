<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CatalogProduct;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogProductsController extends Controller
{
    public function index()
    {
        $products = CatalogProduct::with('category')->get();
        $categories = Category::all();
        return view('admin.catalog_products.index', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('catalog_products', 'public');
        }

        CatalogProduct::create($data);

        return redirect()->route('catalog_products.index')->with('success', 'Product added successfully');
    }

    public function update(Request $request, CatalogProduct $catalogProduct)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('catalog_products', 'public');
        }

        $catalogProduct->update($data);

        return redirect()->route('catalog_products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(CatalogProduct $catalogProduct)
    {
        $catalogProduct->delete();
        return redirect()->route('catalog_products.index')->with('success', 'Product deleted successfully');
    }
}
