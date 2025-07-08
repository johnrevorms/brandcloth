<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalController;

Route::get('/journal/{id}', [JournalController::class, 'show']);

Route::get('/', fn() => view('welcome'));
Route::get('/shop', fn() => view('shop'));
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

Route::get('/laporan', function () {
    return view('laporan'); // Asumsikan kamu pakai file resources/views/laporan.blade.php
});

Route::get('/verifikasi', function () {
    return view('verifikasi'); // Asumsikan kamu pakai file resources/views/laporan.blade.php
});

Route::get('/konfirmasi', function () {
    return view('konfirmasi'); // Asumsikan kamu pakai file resources/views/laporan.blade.php
});
