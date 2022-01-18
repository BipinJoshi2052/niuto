<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PickupDetail extends Model
{
    protected $table = 'pickup_detail';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pickup_id','language_id'
    ];

    public function language()
    {
        return $this->belongsTo('App\Models\Admin\Language','language_id','id');
    }

    public function country()
    {
        return $this->belongsTo("App\Models\Admin\Country", "country", "id");
    }

    public function state()
    {
        return $this->belongsTo("App\Models\Admin\State", "state", "id");
    }
}
