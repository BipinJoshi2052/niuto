<?php

namespace App\Repository\Web;

use App\Contract\Web\OrderInterface;
use App\Traits\ApiResponser;
use Illuminate\Support\Collection;
use App\Jobs\OrderProcess;
use App\Models\Admin\OrderComment;
use App\Services\Admin\OrderService;
use Session;
use App\Models\Web\OrderHistory;

class OrderRepository implements OrderInterface
{
    use ApiResponser;

    public function store(array $parms)
    {
        try {
            $cartItemValidation = new OrderService;
            $cartItemValidation = $cartItemValidation->CartItemValidation();
            if ($cartItemValidation == 0)
                return $this->errorResponse('Empty Cart!');
            
            // $parms['action'] = '';
            // if($parms['payment_method'] == 'PayPal'){
            //     $parms['customer_id'] = \Auth::id();
            //     Session::put('order_data',$parms);
            //     // return $parms = Session::get('order_data');
            //     $parms['action'] = 'PayPal';
            // }
            // dd($parms);
            // dd(OrderProcess::dispatchNow($parms));
            return OrderProcess::dispatchNow($parms);
            return $this->successResponse(OrderProcess::dispatchNow($parms), 'Data Get Successfully!');
        } catch (Exception $e) {
            return $this->errorResponse();
        }
    }

    public function update($order , array $parms)
    {
        
        try {
            $order->update(['order_status'=>$parms['order_status']]);
            OrderHistory::create([
                'order_id'=>$order->id,
                'order_status' =>  $parms['order_status']
            ]);

            return $this->successResponse('', 'Status Updated Successfully!');

        } catch (Exception $e) {
            return $this->errorResponse();
        }
    }

    public function addOrderComments(array $parms){
        // return \Auth::id();
        $data = array('order_id'=>1,'message'=>$parms['comment'],'customer_id' => \Auth::id());
        try {
            $orderComments = OrderComment::create($data);
        } catch (Exception $e) {
            return $this->errorResponse();
        }

        if ($orderComments) {
            // return $orderNotes;  
            return $this->successResponseArray([$orderComments], 'Order Update Successfully!');
        } else {
            return $this->errorResponse();
        }
    }
}
