<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//panggil ProductController sebagai object
use App\Http\Controllers\ProductController;
//buat route untuk menambahkan data pruduct
Route::post('/product',[ProductController::class,'store']);
//route untuk menampilkan data produk keseluruhan
Route::get('/product',[ProductController::class,'showAll']);
//route untuk menampilkan data produk berdasarkan ID
Route::get('/product/{id}',[ProductController::class,'showById']);
//route untuk menampilkan data produk berdasarkan nama
Route::get('/product/search/product_name={product_name}',[ProductController::class,'showByName']);
//route untuk mengubah data produk berdasarkan ID produk
Route::put('/product/{id}',[ProductController::class,'update']);
//route untuk menghapus data produk berdasarkan ID produk
Route::delete('/product/{id}',[ProductController::class,'delete']);
