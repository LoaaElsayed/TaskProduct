<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService){}


    public function index(Request $request){
        return $this->productService->index($request);
    }
    public function store(ProductRequest $request){
        return $this->productService->store($request);
    }

}
