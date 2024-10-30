<?php

namespace App\Repositories\Order;

use App\Helper\ApiResponse;
use App\Jobs\ProcessOrder;
use App\Jobs\RequestOrder;
use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Coupon;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class OrderRepository implements OrderInterface
{
    public function checkout($cart_id, $couponCode = null)
    {
        $cart = Cart::findOrFail($cart_id);
        $items = CartDetails::where("cart_id", $cart_id)->get();
        foreach ($items as $itemData) {
            $itemData->status = 1;
            $itemData->save();
        }
        $coupon = Coupon::where('code', $couponCode)->first();
        if ($coupon) {
            $finalPrice = $this->useCoupon($couponCode, $cart->total_price);
        } else {
            $finalPrice = $cart->total_price;
        }
        $order = Order::create([
            "cart_id" => $cart_id,
            "total_price" => $cart->total_price,
            "final_total" => $finalPrice,
            "coupon_id" => $couponCode ? $coupon->id : null,
            "status" => "unpaid",
        ]);
        $cart->status = 1;
        $cart->save();

        return $order;
    }



    public function useCoupon($code, $cartPrice)
    {
        $coupon = Coupon::where('code', $code)->first();
        if (!$coupon) {
            return response()->json(["error" => "Coupon does not exist"], 400);
        }
        if (Carbon::now()->gt($coupon->expaired_date)) {
            return response()->json(["error" => "This coupon has expired"], 400);
        }
        $discountAmount = $cartPrice * ($coupon->value / 100);
        return $cartPrice - $discountAmount;
    }



    public function placeOrder(int $cartId, ?string $couponCode = null)
    {
        ProcessOrder::dispatch($cartId, $couponCode);
        return ApiResponse::sendresponse(200, "Order is being processed");
    }
}
