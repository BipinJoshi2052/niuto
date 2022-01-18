<?php

namespace App\Http\Controllers\API\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin\Country;
use App\Models\Admin\Pickup;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\Request;

class PickupController extends Controller
{
    use ApiResponser;

    public function all(Request $request)
    {
        try{
            $pickup_points = Pickup::where("country", $request->country_id)->with(['country', 'state'])->get();
            return response()->json(["data" => $pickup_points, "message" => "Data get successfully", "status" => "success"]);
        } catch(Exception $e){
            return response()->json(["error"=>$e->getMessage(), "status" => "error"]);
        }
    }


    public function getSinglePickupDetail(Request $request)
    {
        try{
            $pickup_point = Pickup::where("id", $request->pickup_id);
            if($pickup_point->exists()){
                $pickup_point = $pickup_point->with(['country', 'state'])->first();
                return response()->json(['data' => $pickup_point, "message" => "Data get successfully", "status" => "success"]);
            } else {
                return response()->json(['error'=>"Something went wrong", "status" => "error"]);
            }
        } catch(Exception $e){
            return response()->json(["error" => $e->getMessage(), "status" => "error"]);
        }
    }
}
