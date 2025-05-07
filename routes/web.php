<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/journal', function () {
    return view('journal');
});

Route::get('/about', function () {
    return view('about');
});