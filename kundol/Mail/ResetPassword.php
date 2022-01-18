<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    // public $name;
    // public $token;
    // public $email;
    public $customer;


    public function __construct($customer)
    {
        // $this->name = $name;
        // $this->email = $email;
        // $this->token = $token;
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    // public function build()
    // {
        // $customer['name'] = $this->name;
        // $customer['email'] = $this->email;
        // $customer['reset_token'] = $this->token;
    //     return $this->from(env("MAIL_FROM_ADDRESS", env("APP_NAME"))->subject("Password Reset Link")
        
    //     ->view('email.forgetPassword', ['customer' => $customer]));
    // }

    public function build()
    {
        // $customer['name'] = $this->name;
        // $customer['email'] = $this->email;
        // $customer['reset_token'] = $this->token;
        return $this->markdown('email.forgetPassword') //pass here your email blade file
	    	->with('customer',$this->customer);
    }
}
