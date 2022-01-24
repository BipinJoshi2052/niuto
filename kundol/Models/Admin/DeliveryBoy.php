<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
class DeliveryBoy extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens;
    use SoftDeletes;
    protected $fillable = [
        'first_name','last_name','email','phone_number','avatar','dob','blood_group','commission','email_address','pin_code','status', 'password',
        'availability_status','address','city','country','in_active','zip_code','state','vehicle_name','owner_name','vehicle_color','vehicle_registration_no','vehicle_details','driving_license_no','vehicle_rc_book_no','account_name','account_number','gpay_number','bank_address','ifsc_code','branch_name'];



    
    public function orders()
    {
        return $this->hasMany('App\Models\Admin\Order', 'delivery_boy_id', 'id');
    }
}
