<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(protected CartService $cartService){}


    public function addToCart(Request $request){
        return $this->cartService->addToCart($request);
    }
}
