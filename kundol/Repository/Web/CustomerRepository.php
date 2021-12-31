<?php

namespace App\Repository\Web;

use App\Contract\Web\CustomerInterface;
use App\Http\Resources\Web\Customer as CustomerResource;
use App\Models\Admin\Customer;
use App\Traits\ApiResponser;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;

class CustomerRepository implements CustomerInterface
{
    use ApiResponser;

    public function show($customer)
    {
        try {
            return $this->successResponse(new CustomerResource($customer), 'Data Get Successfully!');
        } catch (Exception $e) {
            return $this->errorResponse();
        }
    }

    public function update(array $parms, $customer)
    {
        DB::beginTransaction();
        try {
            if(!isset($parms['type'])){
                if (Auth::check())
                    $parms['updated_by'] = \Auth::id();
                $parms['password'] = Hash::make($parms['password']);
            }
            $sql = $customer->update($parms);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->errorResponse();
        }

        if ($sql) {
            DB::commit();
            return $this->successResponse(new CustomerResource($customer), 'Customer Update Successfully!');
        } else {
            DB::rollback();
            return $this->errorResponse();
        }
    }

    public function changePassword(array $parms)
    {
        // $thi = $this;
        $user = Customer::findOrFail($parms['customerId']);
        if($user->provider && !$user->password){
            $user->fill([
                'password' => Hash::make($parms['new_password'])
            ])->save();
            return $this->successResponse('', 'Password Changed Successfully!');
        }
        if (Hash::check($parms['old_password'], $user['password'])) { 
            $user->fill([
                'password' => Hash::make($parms['new_password'])
            ])->save();
            return $this->successResponse('', 'Password Changed Successfully!');
            // return response()->json('Password Changed Successfully!');
        }
        return $this->errorResponse($message = 'Old password mismatch!');
    }
}
