<?php

namespace App\Http\Controllers\API\Web;

use App\Contract\Web\CustomerAuthInterface;
use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\CustomerLoginRequest;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\ForgetRequest;
use App\Http\Requests\ResetRequest;
use App\Models\Admin\Customer;
use App\Models\User;
use App\Repository\Web\CustomerAuthRepository;
use Auth;
use Illuminate\Http\Request;
use Socialite;

class CustomerAuthController extends Controller
{
    private $CustomerAuthRepository;

    public function __construct(CustomerAuthInterface $CustomerAuthRepository)
    {
        $this->CustomerAuthRepository = $CustomerAuthRepository;
    }

    public function register(CustomerStoreRequest $request)
    {
        $parms = $request->all();
        return $this->CustomerAuthRepository->store($parms);
    }

    public function forgetPassword(ForgetRequest $request)
    {
        $parms = $request->all();
        return $this->CustomerAuthRepository->forgetPassword($parms);
    }

    public function resetPassword(ResetRequest $request)
    {
        $parms = $request->all();
        return $this->CustomerAuthRepository->resetPassword($parms);
    }

    public function login(CustomerLoginRequest $request)
    {
        if (auth()->guard('customer')->user() || $request->cookie('_customer_token')) {
            return response()->json(['status' => 'Warning', "message" => "Already logged in", "_token" => $request->cookie('_token')], 200);
        }

        $parms = $request->all();
        return $this->CustomerAuthRepository->login($parms);
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

   

    public function Callback($provider)
    {
        $userSocial = Socialite::driver($provider)->stateless()->user();
        $users = Customer::where(['email' => $userSocial->getEmail()])->first();
        if ($users) {
            return $this->CustomerAuthRepository->loginWithProvider($users);
        } else {
            if($userSocial->getName() != ''){
                $arr = explode(' ', $userSocial->getName());
                $first_name = $arr[0];
                $last_name = end($arr);
            }else{
                $first_name = '';
                $last_name = '';
            }
            $user = Customer::create([
                'first_name'    => $first_name,
                'last_name'    => $last_name,
                'email'         => $userSocial->getEmail(),
                'provider_id'   => $userSocial->getId(),
                'provider'      => $provider,
            ]);
            return $this->CustomerAuthRepository->loginWithProvider($user);
        }
    }

    public function logout(Request $request)
    {
        $parms = $request->all();
        return $this->CustomerAuthRepository->logout($parms);
    }
}
