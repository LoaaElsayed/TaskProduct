<?php

namespace App\Repositories\Cart;

use App\Helper\ApiResponse;
use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class CartRepository implements CartInterface
{

    public function __construct(
        protected Product $model,
        protected ProductAttribute $productAttribute,
        protected Cart $cart,
        protected CartDetails $cartDetails,
    ){}

    public function addToCart($request){
        $userId = 1; // auth()->user()->id;
        DB::beginTransaction();
        try {
            $cart = Cart::where('user_id', $userId)->first();
            if($cart){
                $cart->count += 1;
                $cart->save();
            }else{
                $cart = Cart::create([
                    "user_id" => $userId,
                    "count" => 1,
                ]);
            }
            $product = Product::find($request->product_id);
            $productAttribute = ProductAttribute::find($request->attribute_id);
            $productAttributeValue = ProductAttributeValue::find($request->attribute_value_id);
            if($productAttributeValue->price == "0.00"){
                $priceValue = $product->price * $request->quantity ;
            }else{
                $priceValue = $productAttributeValue->price * $request->quantity;
            }

            $cartDetails = Cartdetails::create([
                "cart_id" => $cart->id,
                "product_id" => $request->product_id,
                "attribute_id" => $request->attribute_id,
                "attribute_value_id" => $request->attribute_value_id,
                "quantity" => $request->quantity,
                "total_price" => $priceValue ,
                "status" => 1,
            ]);

            $total_price = Cartdetails::where('cart_id', $cart->id)->sum('total_price');
            $cart->total_price = $total_price;
            $cart->save();

            DB::commit();
            return ApiResponse::sendresponse(200, "add to cart success",$cart);
        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponse::sendresponse(500, "Error while adding product$e" );
        }
    }







}
