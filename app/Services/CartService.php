<?php

namespace App\Services;

use App\Repositories\Cart\CartInterface;

class CartService
{

    public function __construct(protected CartInterface $cartInterface){}

    public function addToCart($request){
        return $this->cartInterface->addToCart($request);
    }


}
