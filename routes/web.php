<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/shop', function () {
    return view('shop');
});

Route::get('/produk/{id}', function ($id) {
    return view('produk', ['productId' => $id]);
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/journal', function () {
    return view('journal');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/about', function () {
    return view('about');
});


Route::view('/faq', 'faq');
Route::view('/how-to-order', 'howtoorder');
Route::view('/refund-policy', 'refund');
Route::view('/payment-confirmation', 'payment');
