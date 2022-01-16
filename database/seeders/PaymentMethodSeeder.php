<?php

namespace Database\Seeders;

use App\Models\Admin\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::where('id', '>', '0')->delete();
        PaymentMethod::insertOrIgnore([
            [
                'payment_method' => 'paypal',
                'default' => '1',
            ],
            
            [
                'payment_method' => 'stripe',
                'default' => '0',
            ],
            [
                'payment_method' => 'banktransfer',
                'default' => '0',
            ],
            [
                'payment_method' => 'cash_on_delivery',
                'default' => '0',
            ],
            // [
            //     'payment_method' => 'instamojo',
            // ],
            // [
            //     'payment_method' => 'braintree',
            // ],
            // [
            //     'payment_method' => 'hyperpay',
            // ],
            // [
            //     'payment_method' => 'razor_pay',
            // ],
            // [
            //     'payment_method' => 'pay_tm',
            // ],
            
            // [
            //     'payment_method' => 'paystack',
            // ],
            // [
            //     'payment_method' => 'midtrans',
            // ],

        ]);
    }
}
