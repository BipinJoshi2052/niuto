<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Traits\ApiResponser;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Resources\Web\Order as OrderResource;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Events\OrderProcessed;
use App\Models\Admin\Account;
use App\Models\Admin\Currency;
use App\Models\Admin\DefaultAccount;
use App\Models\Admin\PaymentMethod;
use App\Models\Admin\PaymentMethodSetting;
use App\Models\Admin\ShippingMethod;
use App\Models\Admin\TaxRate;
use App\Models\Admin\Transaction;
use App\Models\Admin\TransactionDetail;
use App\Models\Web\OrderHistory;
use App\Services\Admin\OrderService;
use App\Models\Web\Order;
use Omnipay\Omnipay;


class OrderProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ApiResponser;
    public $gateway;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $parms;
    
    public function __construct($parms)
    {
        $this->parms = $parms;
        $this->gateway = Omnipay::create('PayPal_Pro');
        $payment = PaymentMethodSetting::where('payment_method_id',1)->get();
        $this->gateway->setUsername(isset($payment[0]->value) ? $payment[0]->value : '');
        $this->gateway->setPassword(isset($payment[1]->value) ? $payment[1]->value : '');
        $this->gateway->setSignature(isset($payment[2]->value) ? $payment[2]->value : '');
        $this->gateway->setTestMode(true); // here 'true' is for sandbox. Pass 'false' when go live
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        try {
            \DB::beginTransaction();
            $orderService = new OrderService;
                
            $amount = 0;
            $customer_id = \Auth::id();
            // dd($customer_id);
            $currency = Currency::defaultCurrency()->select('exchange_rate', 'symbol_position', 'code')->first();
            // dd($currency);
            if($customer_id == '' || $customer_id == null){
                $customer_id = $this->parms['customer_id'];
            }

            $stockValidate = $orderService->CheckStock($customer_id);
            // return $stockValidate;
            // dd($stockValidate);
            if ($stockValidate['status'] == 'Error')
                return $stockValidate;

            if (isset($this->parms['coupon_code'])) {
                $couponValidate = $orderService->CouponCodeValidation($this->parms['coupon_code'], $customer_id, $customer_id);
                if ($couponValidate['status'] == 'Error')
                    return $couponValidate;
                $sql = $couponValidate['data'];
                if ($sql->type == 'percentage') {
                    $amount = ($stockValidate['data'] / 100) * $sql->amount;
                } else {
                    $amount = $sql->amount;
                }
                $this->parms['coupon_amount'] = $amount * $currency->exchange_rate;
            }
            $this->parms['order_price'] = $stockValidate['data'];
            $this->parms['order_price'] = $this->parms['order_price'] * $currency->exchange_rate;
            $this->parms['order_price'] = $this->parms['order_price'] - $amount;
            if($this->parms['payment_method'] == 'stripe'){
                $paymentMethod = $orderService->paymentMethod($this->parms['payment_method'], $this->parms['cc_number'], $this->parms['cc_expiry_month'], $this->parms['cc_expiry_year'], $this->parms['cc_cvc'], $this->parms['order_price']);

                if ($paymentMethod['status'] == 'Error')
                    return $paymentMethod;
                
                if($paymentMethod['message'] == 'Success'){
                    $this->parms['order_status'] = 'Complete';
                }
            }
            else if($this->parms['payment_method'] == 'paypal'){

                $formData = array(
                    'firstName' => $this->parms['billing_first_name'],
                    'lastName' => $this->parms['billing_last_name'],
                    'number' => $this->parms['cc_number'],
                    'expiryMonth' => $this->parms['cc_expiry_month'],
                    'expiryYear' => $this->parms['cc_expiry_year'],
                    'cvv' => $this->parms['cc_cvc']
                );
        
                try {
                    // Send purchase request
                    $response = $this->gateway->purchase([
                        'amount' => $this->parms['order_price'],
                        'currency' => 'USD',
                        'card' => $formData
                    ])->send();
        
                    // Process response
                    if ($response->isSuccessful()) {
        
                        // Payment was successful
                        $arr_body = $response->getData();
                        $amounts = $arr_body['AMT'];
                        $currencies = $arr_body['CURRENCYCODE'];
                        $transaction_id = $arr_body['TRANSACTIONID'];
        
                        // echo "Payment of $amount $currency is successful. Your Transaction ID is: $transaction_id";
                        $this->parms['order_status'] = 'Complete';
                        $this->parms['transaction_id'] = $transaction_id;
                        $paymentMethod['message'] = 'Success';
                    } else {
                        // Payment failed
                        $this->parms['order_status'] = 'Pending';
                        $this->parms['transaction_id'] = '';
                        $paymentMethod['message'] = '';
                    }
                } catch(Exception $e) {
                    
                }
            }
            // return $this->parms['order_status'];
            $tax_rate = TaxRate::findByState($this->parms['delivery_state'])->get();
            // dd($tax_rate);
            $total = 0;
            foreach($tax_rate as $tax_rates){
                $total = $total + $tax_rates->tax_rate;
            }
            $total = $total * floatVal($currency->exchange_rate);
            $shippingMethodPrice = ShippingMethod::where('is_default', '1')->first();
            $shipping_method_price = 0;
            if($shippingMethodPrice){
                $shipping_method_price = $shippingMethodPrice->amount * $currency->exchange_rate;
                $this->parms['shipping_method'] = $shippingMethodPrice->methods_type_link;
            }

            $this->parms['total_tax'] = $total;
            $this->parms['shipping_cost'] = $shipping_method_price;
            $this->parms['order_price'] = $this->parms['order_price'] + $total + $shipping_method_price;

            // if(isset($this->parms['action']) && $this->parms['action'] == 'PayPal'){
            //     return $this->successResponseArray($this->parms['order_price'], 'PayPal');
            // }

            $this->parms['customer_id'] = $customer_id;
            $this->parms['currency_id'] = $currency->id;
            $this->parms['currency_value'] = $currency->exchange_rate;
            
            $sql = Order::create($this->parms);
            // dd($sql);
            OrderHistory::create([
                'order_id'=>$sql->id,
                'order_status' => 'Pending'
            ]);

            if($this->parms['payment_method'] != 'cod' && $this->parms['payment_method'] != 'esewa' && $this->parms['payment_method'] != 'banktransfer'){
                if($paymentMethod['message'] == 'Success'){
                    $orderService->CompleteTransaction($sql, $this->parms['customer_id']);
                }
            }


            // $default_account = DefaultAccount::pluck('account_id', 'type')->toArray();
            // $account_id = Account::where('type', 'customer')->where('reference_id', $this->parms['customer_id'])->value('id');
            // if (!$account_id) {
            //     $account_id = $default_account['customer'];
            // }
            //     $inc = Transaction::latest()->value('transaction_number');
            //     $inc = intVal($inc);
            //     $inc++;
            //     $trans_id = Transaction::create([
            //         'transaction_number' => $inc,
            //         'transaction_date' => date('Y-m-d'),
            //         'description' => 'order sale item'
            //     ]);
            //     TransactionDetail::create([
            //         'transaction_id' => $trans_id->id,
            //         'account_id' => $default_account['cash'],
            //         'reference_id' => $sql->id,
            //         'type' => 'cash',
            //         'dr_amount' => $sql->order_price,
            //         'cr_amount' => '0'
            //     ]);

            //     TransactionDetail::create([
            //         'transaction_id' => $trans_id->id,
            //         'account_id' => $account_id,
            //         'reference_id' => $sql->id,
            //         'type' => 'sale',
            //         'dr_amount' => '0',
            //         'cr_amount' => $sql->total_tax
            //     ]);
            //     TransactionDetail::create([
            //         'transaction_id' => $trans_id->id,
            //         'account_id' => $account_id,
            //         'reference_id' => $sql->id,
            //         'type' => 'sale',
            //         'dr_amount' => '0',
            //         'cr_amount' => $sql->coupon_amount
            //     ]);
            //     TransactionDetail::create([
            //         'transaction_id' => $trans_id->id,
            //         'account_id' => $account_id,
            //         'reference_id' => $sql->id,
            //         'type' => 'sale',
            //         'dr_amount' => '0',
            //         'cr_amount' => $sql->shipping_cost
            //     ]);

            //     $remaining = intVal($sql->order_price) - intVal($sql->total_tax) - intVal($sql->coupon_amount) - intVal($sql->shipping_cost);

            //     TransactionDetail::create([
            //         'transaction_id' => $trans_id->id,
            //         'account_id' => $account_id,
            //         'reference_id' => $sql->id,
            //         'type' => 'sale',
            //         'dr_amount' => '0',
            //         'cr_amount' => $remaining
            //     ]);

        } catch (Exception $e) {
            return $this->errorResponse();
        }
        if ($sql) {
            $this->parms["warehouse_id"] = 3;
             OrderProcessed::dispatch($sql->id);
            \DB::commit();
            return $this->successResponse(new OrderResource($sql), 'Order Save Successfully!');
        } else {
            \DB::rollback();
            return $this->errorResponse();
        }
    }
}
