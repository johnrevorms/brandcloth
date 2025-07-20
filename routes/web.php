<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\CategoryController;

// ==========================
// Controller-based Routes
// ==========================

Route::get('/journal/{id}', [JournalController::class, 'show']);
Route::get('/shop', [CategoryController::class, 'index']);
Route::get('/products/{category}', [CategoryController::class, 'filter']);

// ==========================
// Static Page Views
// ==========================

Route::get('/', fn() => view('welcome'));
Route::get('/produk/{id}', fn($id) => view('produk', ['productId' => $id]));
Route::get('/cart', fn() => view('cart'));
Route::get('/profile', fn() => view('profile'));
Route::get('/journal', fn() => view('journal'));
Route::get('/login', fn() => view('login'));
Route::get('/register', fn() => view('register'));
Route::get('/about', fn() => view('about'));

Route::view('/faq', 'faq');
Route::view('/how-to-order', 'howtoorder');
Route::view('/refund-policy', 'refund');
Route::view('/payment', 'payment')->name('payment');
Route::view('/payment-confirmation', 'payment-confirmation')->name('payment.confirmation');
Route::view('/shipping-confirmation', 'shipping-confirmation')->name('shipping.confirmation');
Route::view('/status-payment', 'status-payment')->name('payment.status');
Route::view('/payment-information', 'payment-information');
// ==========================
// Laporan/Admin Views
// ==========================

Route::get('/laporan', fn() => view('laporan'));
Route::get('/paymentproof', function () {
    return view('paymentproof');
});
Route::get('/order', fn() => view('order'));

Route::get('/order/{id}', function ($id) {
    return view('order', ['order_id' => $id]);
});

Route::get('/editproduk', function () {
    return view('editproduk'); // sesuaikan jika ada folder views
});

Route::get('/tambah-journal', function () {
    return view('namjour');
});



// ==========================
// Optional: Duplicate product filter via view if needed
// (pastikan CategoryController::filter sudah cover ini)
// ==========================

// Route::get('/products/{category}', function ($category) {
//     $categories = Http::get('http://127.0.0.1:9000/api/categories')->json();
//     return view('shop', [
//         'categories' => $categories,
//         'selectedCategory' => $category,
//     ]);
// });
