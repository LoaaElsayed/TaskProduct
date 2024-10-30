<?php

namespace App\Services;

use App\Repositories\Products\ProductInterface;

class ProductService
{

    public function __construct(protected ProductInterface $productInterface){}


    public function index($request){
        return $this->productInterface->index($request);
    }
    public function store($request){
        return $this->productInterface->store($request);
    }

}
