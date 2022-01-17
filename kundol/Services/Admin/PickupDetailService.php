<?php

namespace App\Services\Admin;

use App\Models\Admin\PickupDetail;
use App\Traits\ApiResponser;
use DB;

class PickupDetailService
{
    use ApiResponser;
    public function store($parms, $pickupId)
    {
        foreach ($parms['language_id'] as $i => $data) {

            $arr['language_id'] = $parms['language_id'][$i];
            $arr['name'] = $parms['name'][$i];
            $arr['country'] = $parms['country'][$i];
            $arr['state'] = $parms['state'][$i];
            $arr['city'] = $parms['city'][$i];
            $arr['phone'] = $parms['phone'][$i];
            $arr['postalcode'] = $parms['postalcode'][$i];

            try {
                $arr['pickup_id'] = $pickupId;
                $query = new PickupDetail;
                $query->create($arr);
            } catch (Exception $e) {
                DB::rollback();
                return $this->errorResponse('Some thing went Wrong! Please try Again.', 401);
            }
        }
        return 1;
    }

    public function update($parms, $pickupId)
    {
        $arr['pickup_id'] = $pickupId;
        $query = PickupDetail::where('pickup_id', $pickupId)->delete();
        foreach ($parms['language_id'] as $i => $data) {
            $arr['language_id'] = $parms['language_id'][$i];
            $arr['name'] = $parms['name'][$i];
            $arr['country'] = $parms['country'][$i];
            $arr['state'] = $parms['state'][$i];
            $arr['city'] = $parms['city'][$i];
            $arr['phone'] = $parms['phone'][$i];
            $arr['postalcode'] = $parms['postalcode'][$i];
            try {
                $query = new PickupDetail;
                $query->create($arr);
            } catch (Exception $e) {
                DB::rollback();
                return $this->errorResponse('Some thing went Wrong! Please try Again.', 401);
            }
        }
        return 1;
    }
}
