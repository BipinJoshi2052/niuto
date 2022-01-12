<?php

namespace App\Http\Controllers\API\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customer;
use App\Models\Admin\Gallary;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    use ApiResponser;

    public function updateUserProfileImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "file" => ['required', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if ($validator->passes()) {
            $user = Customer::select('customers.*')->find(auth()->user()->id);
            $destination = "gallary/";
            $image = $request->file('file');
            $imageName = $image->getClientOriginalName();
            $gallery = new Gallary();
            $gallery->name = $imageName;
            $gallery->extension = $request->file->getMimeType();
            $gallery->created_at = date('Y-m-d');
            $gallery->updated_at = date('Y-m-d');
            $gallery->save();
            $user->update(["gallary_id" => $gallery->id]);
            $image->move($destination, $imageName);
            return response()->json(['msg' => 'Profile picture updated successfully.', 'profile_image' => $imageName]);
        }
    }
}
