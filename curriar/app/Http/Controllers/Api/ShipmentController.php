<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Resources\UserCollection;
use App\Http\Helpers\ApiHelper;
use App\User;
use App\Mission;
use App\BusinessSetting;
use App\ShipmentSetting;

class ShipmentController extends Controller
{
    public function getCaptainMissions(Request $request)
    {
        
    }

    public function getPaymentTypes(Request $request)
    {
        $apihelper = new ApiHelper();
        $user = $apihelper->checkUser($request);

        if($user){
            $payments = BusinessSetting::where('key', 'payment_gateway')->where('value',1)->get();
            return response()->json($payments);
        }else{
            return response()->json('Not Authorized');
        }
    }

    public function getSetting(Request $request)
    {
        $apihelper = new ApiHelper();
        $user = $apihelper->checkUser($request);

        if($user){
            $payments = ShipmentSetting::whereIn('key',['is_date_required' , 'def_shipping_date' , 'def_shipment_type' , 'def_payment_type' , 'def_payment_method' , 'def_package_type' , 'def_branch'])->get();
            return response()->json($payments);
        }else{
            return response()->json('Not Authorized');
        }
    }
}