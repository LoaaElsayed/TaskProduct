<?php

namespace App\Repositories\Products;

interface ProductInterface
{

    public function index($request);
    public function store($request);
}
