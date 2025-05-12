<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CatalogProductsController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\ListsUsersController;
use App\Http\Controllers\admin\NotifyController;
use App\Http\Controllers\admin\OrderPaymentController;
use App\Http\Controllers\admin\PdfController;
use App\Http\Controllers\admin\PromoController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\RiwayatTransaksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\user\CheckoutController;
use App\Http\Controllers\user\RatingController;
use App\Http\Controllers\user\UserCategoriesController;
use App\Http\Controllers\user\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [UserController::class, 'index'])->name('landing_page');
Route::get('/produk/{id}', [UserController::class, 'show'])->name('produk.show');
Route::get('/berita', [UserController::class, 'news'])->name('news');
Route::get('/berita/{id}', [UserController::class, 'newsDetail'])->name('news.detail');
Route::get('/kuliner', [UserController::class, 'kuliner'])->name('kuliner');
Route::get('/kuliner/{id}', [UserController::class, 'kulinerDetail'])->name('kuliner.detail');
Route::get('/profil', [UserController::class, 'about'])->name('about');

Auth::routes(['middleware' => ['redirectIfAuthenticated']]);


Route::middleware(['auth', 'role.admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('categories', CategoriesController::class)->except(['create', 'edit']);
    Route::resource('catalog_products', CatalogProductsController::class);
    Route::resource('orders_payment', OrderPaymentController::class);
    Route::post('orders_payment/{order}/update-status', [OrderPaymentController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('orders_payment/{order}/confirm-payment', [OrderPaymentController::class, 'confirmPayment'])->name('orders.confirm-payment');
    Route::post('orders_payment/{order}/complete-order', [OrderPaymentController::class, 'completeOrder'])->name('orders.complete-order');
    Route::get('orders/{id}/download-invoice', [PdfController::class, 'downloadInvoice'])->name('orders.download-invoice');
    Route::resource('list-users', ListsUsersController::class);
    Route::resource('riwayat-transaksi', RiwayatTransaksiController::class);
    Route::resource('promo', PromoController::class);
    Route::post('/promo/{productId}', [PromoController::class, 'store']);
    Route::resource('report', ReportController::class);
    Route::resource('notify', NotifyController::class);
    Route::get('/notifyread/read', [NotifyController::class, 'notifyread'])->name('notifyread');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
});

Route::middleware(['auth', 'role.user'])->group(function () {
    Route::get('/home', [UserController::class, 'index'])->name('home');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update-quantity/{item}', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');
    Route::post('/cart/remove-item/{item}', [CartController::class, 'removeItem'])->name('cart.remove-item');
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/orders/{order}', [CheckoutController::class, 'showOrder'])->name('orders.show');
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
});

Route::get('/categories/{category}', [UserCategoriesController::class, 'show'])
    ->name('categories.show');
Route::get('/products/{product}', [UserCategoriesController::class, 'productDetail'])
    ->name('products.detail');
Route::get('/search', [UserCategoriesController::class, 'search'])->name('products.search');

Route::get('/faq', [
    'as' => 'faq',
    function () {
        return view('user.faq.index');
    }
]);
Route::get('/about', [
    'as' => 'about',
    function () {
        return view('user.about.index');
    }
]);
Route::get('/contact', [
    'as' => 'contact',
    function () {
        return view('user.contact.index');
    }
]);
