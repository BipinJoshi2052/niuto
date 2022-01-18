<?php

namespace App\Http\Controllers\API\Web;

use App\Contract\Web\OrderInterface;
use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Admin\Customer;
use App\Models\Web\CustomerAddressBook;
use App\Models\Web\Order;
use App\Repository\Web\OrderRepository;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\Auth;
use Stripe\Error\Card;

class OrderController extends Controller
{
    private $OrderRepository;

    public function __construct(OrderInterface $OrderRepository)
    {
        $this->OrderRepository = $OrderRepository;
    }

    public function store(OrderRequest $request)
    {
        $customer = Customer::where("id", Auth::id())->with('customer_address_book')->first();
        if($customer->customer_address_book->isEmpty()){
            $customer_address = new CustomerAddressBook();
            $customer_address->customer_id = Auth::id();
            $customer_address->first_name = $request->billing_first_name;
            $customer_address->last_name = $request->billing_last_name;
            $customer_address->street_address = $request->billing_street_aadress;
            $customer_address->phone = $request->billing_phone;
            $customer_address->postcode = $request->billing_postcode;
            $customer_address->city = $request->billing_city;
            $customer_address->country_id = $request->billing_country;
            $customer_address->state_id = $request->billing_state;
            $customer_address->is_default = 1;
            $customer_address->save();
        }
        
        $parms = $request->all();
        return $this->OrderRepository->store($parms);
    }

    public function Update(Order $order,Request $request)
    {
        $this->validate($request,[
            'order_status'=>'required',
         ]);
        return $this->OrderRepository->update($order,$request->all());
    }
    
    public function addOrderComments(Request $request)
    {
        $this->validate($request,[
            'id'=>'required|exists:orders',
            'comment' =>'required',
         ]);

        $parms = $request->all();
        return $this->OrderRepository->addOrderComments($parms);
    }
}
