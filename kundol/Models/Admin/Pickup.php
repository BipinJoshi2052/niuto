<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pickup extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'country', 'state', 'city', 'phone', 'postalcode', 'is_active', 'created_by', 'updated_by'
    ];

    public function scopeGetPickupDetailByLanguageId($query, $languageId)
    {
        return $query->with(['detail' => function ($q) use ($languageId) {
            $q->where('language_id', $languageId);
        }]);
    }

    public function detail()
    {
        return $this->hasMany('App\Models\Admin\PickupDetail', 'pickup_id', 'id');
    }

    public function scopePickupId($query, $id)
    {
        return $query->where('id', $id);
    }

    public function scopeSortBypickupDetail($query, $sortBy, $sortType, $languageId)
    {
        return $query->orderBy(PickupDetail::select($sortBy)
            ->whereColumn('pickup_detail.pickup_id', 'pickups.id')->where('language_id', $languageId), $sortType);
    }
}