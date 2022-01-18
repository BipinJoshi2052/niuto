<?php

namespace App\Http\Requests;

use App\Models\Admin\Customer;
use Illuminate\Foundation\Http\FormRequest;

class CustomerChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $oldPasswordValidation = ['old_password' => 'required'];
        if($_POST['customerId']){
            $user = Customer::where('id', $_POST['customerId'])->first();
            if($user->provider && !$user->password){
                $oldPasswordValidation = '';
            }
        }
        // dd($oldPasswordValidation);
        $validation = [
            'new_password' => 'required|string|min:6|same:confirm_password',
            'confirm_password' => 'required',
        ];
        if($oldPasswordValidation != ''){
            $validation = array_merge($validation, $oldPasswordValidation);
        }
        return $validation;
        // return [
        //     $oldPasswordValidation,
        //     'new_password' => 'required|string|min:6|same:confirm_password',
        //     'confirm_password' => 'required',
        // ];
    }
}
