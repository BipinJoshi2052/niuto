<?php

namespace App\Repository\Web;

use App\Contract\Web\CustomerAuthInterface;
use App\Http\Controllers\Web\IndexController;
use App\Models\Admin\Customer;
use App\Models\Web\Cart;
use App\Services\Admin\AccountService;
use App\Services\Admin\PointService;
use App\Services\Web\HomeService;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Hash;
use Mail;
use Auth;

use Artisan;

class CustomerAuthRepository implements CustomerAuthInterface
{
    use ApiResponser;
    public function store(array $parms)
    {
        // return "i am in repository";
        $input = $parms;
        $input['password'] = bcrypt($input['password']);
        $input['hash'] = str_replace("/", '1', Hash::make('time'));
        $user = Customer::create($input);
        config(['auth.guards.api.provider' => 'customer']);
        $token = $user->createToken('MyApp', ['customer'])->accessToken;
        $cookie = $this->getCookieDetails($token);
        if (isset($parms['session_id']) && $parms['session_id'] != '') {
            Cart::where('session_id', $parms['session_id'])->update(['customer_id' => $user->id, 'session_id' => '']);
        }
        $points = new PointService;
        $points->customerPoints($parms, $user->id);

        $user['token'] = $token;
        $accounts = new AccountService;
        $accounts->createAccount('CUSTOMER', $input['first_name'], $user->id);

        return response()
            ->json([
                'status' => 'Success',
                'data' => $user,
            ], 200)
            ->cookie($cookie['name'], $cookie['value'], $cookie['minutes'], $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly']);
    }

    // public function forgetPassword(array $parms)
    // {
    //     $link = str_replace("/", '1', Hash::make('time'));
    //     Customer::where('email', $parms['email'])->update(['forget_hash' => $link]);

    //     $data_set = array('link' => $link);
    //     $message = "";
    //     $email = $parms['email'];
    //     Mail::send('emails.forget-password', $data_set, function ($message) use ($email) {
    //         $message->to($email)->subject('Forget Password');
    //     });
    //     return $this->successResponseArray($link, 'Email Sent Successfully! Against this Link');
    // }


    public function forgetPassword(array $parms)
    {
        $customer = Customer::where("email", $parms['email'])->first();
        if($customer != null){
            $token = $link = str_replace("/", '1', Hash::make('time'));
            $customer->update(["reset_token" => $token]);
            try{
                Mail::send('email.forgetPassword', ['token' => $token, "email" => $parms['email']], function($message) use($parms){
                    $message->to($parms['email']);
                    $message->subject('Reset Password');
                });
            }catch (\Exception $e) {
                $bug = $e->getMessage();
                return redirect()->back()->with('error', $bug);
            }
            return $this->successResponseArray($link, 'Password reset link has been successfully sent to your email.');
        } else {
            return $this->successResponseArray('error_msg', 'Your email doesn\'t exist in our database. Please register');
        }
    }

    public function resetPassword(array $parms)
    {
        Customer::where('forget_hash', $parms['forget_id'])->update([
            'password' => bcrypt($parms['password']),
            'forget_hash' => null
        ]);
        return $this->successResponse('', 'Password Change Successfully!');
    }

    public function loginWithProvider($users)
    {
        $users = auth()->guard('customer')->loginUsingId($users->id);
        // $usersq =auth()->guard('customer')->id();
        // print_r($usersq);
        // dd($users);

        config(['auth.guards.api.provider' => 'customer']);

        $user = Customer::select('customers.*')->find(auth()->guard('customer')->user()->id);
        $success =  $user;

        $points = new PointService;
        $points->checkinPoints($success['id']);

        $success['token'] =  $user->createToken('MyApp', ['customer'])->accessToken;
        $cookie = $this->getCookieDetails($success['token']);


        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        return view('home', compact('data', 'setting', 'user'));

        return response()->json([
            'status' => 'Success',
            'data' => $user,
        ], 200)
            ->cookie(
                $cookie['name'],
                $cookie['value'],
                $cookie['minutes'],
                $cookie['path'],
                $cookie['domain'],
                $cookie['secure'],
                $cookie['httponly']
            );
    }

    public function login(array $parms)
    {
        if (auth()->guard('customer')->attempt(['email' => request('email'), 'password' => request('password')])) {

            config(['auth.guards.api.provider' => 'customer']);

            $user = Customer::select('customers.*')->find(auth()->guard('customer')->user()->id);
            if (isset($parms['session_id']) && $parms['session_id'] != '') {
                Cart::where('session_id', $parms['session_id'])->update(['customer_id' => auth()->guard('customer')->user()->id, 'session_id' => '']);
            }
            $success =  $user;

            $points = new PointService;
            $points->checkinPoints($success['id']);

            $success['token'] =  $user->createToken('MyApp', ['customer'])->accessToken;
            $cookie = $this->getCookieDetails($success['token']);
            if($user->Gallary != null){
                $user_gallery = $user->Gallary[0]->name;
                $user_gallery = asset('gallary/'.$user_gallery);
            } else {
                $user_gallery = asset('images/noimage.png');
            }
            return response()->json([
                'status' => 'Success',
                'data' => $user,
                'user_gallary' => $user_gallery,
            ], 200)
                ->cookie(
                    $cookie['name'],
                    $cookie['value'],
                    $cookie['minutes'],
                    $cookie['path'],
                    $cookie['domain'],
                    $cookie['secure'],
                    $cookie['httponly']
                );
        } else {
            return $this->errorResponse('Email and Password are Wrong.', 422);
        }
    }
    public function getCookieDetails($token)
    {
        return [
            'name' => '_customer_token',
            'value' => $token,
            'minutes' => 1440,
            'path' => null,
            'domain' => null,
            // 'secure' => true, // for production
            'secure' => null, // for localhost
            'httponly' => true,
            'type' => 'customer'
        ];
    }

    public function logout(array $parms)
    {
        $token = auth()->user()->token();
        $token->revoke();
        $cookie = \Cookie::forget('_customer_token');
        return response()->json([
            'status' => 'Success',
        ])->withCookie($cookie);
    }
}