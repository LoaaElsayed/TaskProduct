<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/products',[ProductController::class,'index']);
Route::post('/product-store',[ProductController::class,'store']);
Route::post('/add-to-cart',[CartController::class,'addToCart']);
Route::post('/checkout/{cartId}', [OrderController::class, 'placeOrder']);

