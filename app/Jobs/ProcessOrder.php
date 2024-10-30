<?php

namespace App\Jobs;

use App\Http\Controllers\OrderController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $cartId;
    protected $couponCode;

    public function __construct($cartId, $couponCode = null)
    {
        $this->cartId = $cartId;
        $this->couponCode = $couponCode;
    }

    public function handle()
    {
        app(OrderController::class)->checkout($this->cartId, $this->couponCode);
    }
}


