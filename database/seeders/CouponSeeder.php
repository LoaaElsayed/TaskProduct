<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons = [
            [
                'code' => 'SAVE10',
                'name' => '10% Off',
                'discount_percentage' => 10,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(10),
                'expaired_date' => Carbon::now()->addDays(10)

            ],
            [
                'code' => 'SAVE20',
                'name' => '20% Off',
                'discount_percentage' => 20,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(5),
                'expaired_date' => Carbon::now()->addDays(5)

            ],
            [
                'code' => 'WELCOME15',
                'name' => '15% Welcome Discount',
                'discount_percentage' => 15,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(3),
                'expaired_date' => Carbon::now()->addDays(3)

            ],
            [
                'code' => 'HOLIDAY25',
                'name' => 'Holiday Special 25%',
                'discount_percentage' => 25,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(2),
                'expaired_date' => Carbon::now()->addDays(2)

            ],
            [
                'code' => 'FREESHIP',
                'name' => 'Free Shipping',
                'discount_percentage' => 0,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(10),
                'expaired_date' => Carbon::now()->addDays(10)

            ],
        ];

        foreach ($coupons as $coupon) {
            Coupon::create($coupon);
        }
    }
}
