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
}
