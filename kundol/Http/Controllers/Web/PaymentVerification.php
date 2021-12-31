<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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
}
