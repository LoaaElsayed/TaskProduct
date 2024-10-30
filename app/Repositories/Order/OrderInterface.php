<?php

namespace App\Repositories\Order;

interface OrderInterface
{
    public function checkout($cartId, $couponCode);
    public function placeOrder(int $cartId, ?string $couponCode = null);


}
