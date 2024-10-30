<?php

namespace App\Services;

use App\Repositories\Order\OrderInterface;
use App\Repositories\Products\ProductInterface;

class OrderService
{

    public function __construct(protected OrderInterface $orderInterface){}

    public function checkout($cartId, $couponCode){
        return $this->orderInterface->checkout($cartId, $couponCode);
    }

    public function placeOrder($cartId,$request){
        return $this->orderInterface->placeOrder($cartId,$request);
    }


}
