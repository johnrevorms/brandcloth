<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('partials.catagory', function ($view) {
            $response = Http::get('http://127.0.0.1:8000/categories/');
            $categories = $response->successful() ? $response->json() : [];

            // Tambahkan kategori "all" di awal
            array_unshift($categories, ['name' => 'all']);

            $view->with('categories', $categories);
        });
    }

    public function register(): void
    {
        //
    }
}
