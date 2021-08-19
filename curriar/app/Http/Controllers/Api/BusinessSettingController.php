<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Resources\BusinessSettingCollection;
use App\Models\BusinessSetting;
use App\User;

class BusinessSettingController extends Controller
{
    public function index()
    {
        return new BusinessSettingCollection(BusinessSetting::all());
    }
    
    public function googleMapSettings(Request $request)
    {
        if($request->is('api/*')){
            $token = $request->header('token');
            if(isset($token))
            {
                $user = User::where('api_token',$token)->first();

                if(!$user)
                {
                    return response()->json('Not Authorized');
                }
                $business_settings = BusinessSetting::where('type', 'google_map')->first();
                return response()->json($business_settings);    
            }else{
                return response()->json('Not Authorizedd');
            }      
        }
        
    }
}
