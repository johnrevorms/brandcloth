<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Http::get('http://127.0.0.1:9000/api/categories')->json();
        return view('shop', [
            'categories' => $categories,
            'selectedCategory' => null,
        ]);
    }

    public function filter($category)
    {
        $categories = Http::get('http://127.0.0.1:9000/api/categories')->json();
        return view('shop', [
            'categories' => $categories,
            'selectedCategory' => strtolower($category),
        ]);
    }
}
