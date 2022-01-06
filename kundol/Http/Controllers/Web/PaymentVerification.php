<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin\PaymentMethod;
use App\Models\Admin\PaymentMethodSetting;
use App\Models\Web\Order;
use Illuminate\Http\Request;

class PaymentVerification extends Controller
{
    public function verify(Request $request){
        $result = [];
        if($request->q == 'su'){
            $result = [
                'productId' => $request->oid,
                'amount' => $request->amt,
                'refrenceId' => $request->refId,
                'message' => 'Payment Successful!'
            ];
            $orderId = explode('?', $result['productId'])[count(explode('?', $result['productId']))-1];
            Order::where('id', $orderId)->update(array('transaction_id' => $result['refrenceId']));
        }else{
            $result = [
                'message' => 'Payment Unsuccessful!'
            ];
        }
        return redirect('/thankyou')->with('result', $result);
    }

    public function esewaMerchant(Request $request){
        $id = PaymentMethod::where('payment_method', $request->payment_method)->pluck('id')->first();
        $esewaData = PaymentMethodSetting::where('payment_method_id', $id)->pluck('value', 'key');
        return response()->json($esewaData);
    }
}
