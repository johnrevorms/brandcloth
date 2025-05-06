<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/refund-policy', 'refund');
Route::view('/how-to-order', 'howtoorder');
Route::view('/faq', 'faq');
Route::view('/payment-confirmation', 'payment-confirmation');