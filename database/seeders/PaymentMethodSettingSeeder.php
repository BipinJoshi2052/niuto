<?php

namespace Database\Seeders;

use App\Models\Admin\PaymentMethodSetting;
use Illuminate\Database\Seeder;

class PaymentMethodSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethodSetting::where('id', '>', '0')->delete();
        PaymentMethodSetting::insertOrIgnore([
            [
                'payment_method_id' => 1,
                'key' => 'PAYPAL_API_USERNAME',
                'value' => '---',
            ],
            [
                'payment_method_id' => 1,
                'key' => 'PAYPAL_API_PASSWORD',
                'value' => '--',
            ],
            [
                'payment_method_id' => 1,
                'key' => 'PAYPAL_API_SIGNATURE',
                'value' => '--',
            ],
            [
                'payment_method_id' => 2,
                'key' => 'STRIPE_API_KEY',
                'value' => '--',
            ],
            [
                'payment_method_id' => 3,
                'key' => 'BANK_TRANSFER_NAME',
                'value' => '--',
            ],
            [
                'payment_method_id' => 3,
                'key' => 'BANK_TRANSFER_DETAIL',
                'value' => '--',
            ],
            [
                'payment_method_id' => 3,
                'key' => 'BANK_TRANSFER_ACC_NAME',
                'value' => '--',
            ],
            [
                'payment_method_id' => 3,
                'key' => 'BANK_TRANSFER_ACC_NUM',
                'value' => '--',
            ],
            [
                'payment_method_id' => 3,
                'key' => 'BANK_TRANSFER_BANK_NAME',
                'value' => '--',
            ],
            [
                'payment_method_id' => 3,
                'key' => 'BANK_TRANSFER_IFSC',
                'value' => '--',
            ],
            [
                'payment_method_id' => 3,
                'key' => 'BANK_TRANSFER_IBAN',
                'value' => '--',
            ],
            [
                'payment_method_id' => 3,
                'key' => 'BANK_TRANSFER_BIC_SWIFT',
                'value' => '--',
            ],


            
        ]);
    }
}
