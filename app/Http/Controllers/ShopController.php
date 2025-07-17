<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ShopController extends Controller
{
    public function index()
    {
        $response = Http::get('http://127.0.0.1:9000/categories/');

        if ($response->successful()) {
            $categories = $response->json();
        } else {
            $categories = [];
        }

        return view('shop', compact('categories'));
    }
}
