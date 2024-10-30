<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService){}

    public function checkout($cartId, $couponCode){
        return $this->orderService->checkout($cartId, $couponCode);
    }

    public function placeOrder($cartId,Request $request){
        return $this->orderService->placeOrder($cartId,$request->couponCode);
    }

}
