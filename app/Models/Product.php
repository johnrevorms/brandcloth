<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';  // Pastikan nama tabel sesuai dengan yang ada di database

    protected $fillable = ['name', 'description', 'price', 'stock'];
}
