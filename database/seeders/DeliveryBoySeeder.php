<?php

namespace Database\Seeders;

use App\Models\Admin\DeliveryBoy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DeliveryBoySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $delivery_boy = new DeliveryBoy();
        $delivery_boy->first_name = "Amar";
        $delivery_boy->last_name = "Singh";
        $delivery_boy->email = 'amarsingh1@gmail.com';
        $delivery_boy->phone_number = '9800000001';
        $delivery_boy->avatar = 'defaul.png';
        $delivery_boy->dob = '1996-1-10';
        $delivery_boy->blood_group = 'A+';
        $delivery_boy->commission = '2';
        $delivery_boy->email_address = 'amarsingh1@gmail.com';
        $delivery_boy->pin_code = '123456';
        $delivery_boy->password = Hash::make('123456');
        $delivery_boy->status = 1;
        $delivery_boy->availability_status = 1;
        $delivery_boy->address = "Kathmandu";
        $delivery_boy->city = "Lalitpur";
        $delivery_boy->country = 149;
        $delivery_boy->state = 182;
        $delivery_boy->vehicle_name = "Pulsar NS 200";
        $delivery_boy->created_at = date('Y-m-d h:i:s');
        $delivery_boy->updated_at = date('Y-m-d h:i:s');
        $delivery_boy->save();
    }
}
