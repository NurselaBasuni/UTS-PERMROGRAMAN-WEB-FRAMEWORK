<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    //set kolom apa saja yang bisa dilakukan insert secara langsung
    protected $fillable = ['product_name','product_type','product_price','expired_at'];
}
