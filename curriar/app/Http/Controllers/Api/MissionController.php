<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Resources\UserCollection;
use App\Http\Controllers\MissionsController;
use App\Http\Helpers\ApiHelper;
use App\User;
use App\Mission;
use App\Shipment;
use App\MissionLocation;



class MissionController extends Controller
{
    public function getCaptainMissions(Request $request)
    {
        
        $apihelper = new ApiHelper();
        $user = $apihelper->checkUser($request);
        if($user){
            if($user->user_type == "customer"){
                $missions = Mission::where('client_id', $user->userClient->client_id)->get();
            }else{
                $missions = Mission::where('captain_id', $user->userCaptain->captain_id)->get();
            }
            return response()->json($missions);
        }else{
            return response()->json('Not Authorized');
        }
    }

    public function changeMissionApi(Request $request)
    {
        $apihelper = new ApiHelper();
        $missionsController = new MissionsController();
        $model = new MissionLocation();
        $user = $apihelper->checkUser($request);
        if($user){
            $status = $missionsController->change($request,$request->to,true);
            if($status == 'success'){

                $mission = Mission::where('id',$request->checked_ids[0])->first();
                $shipment_ids = $mission->shipment_mission->pluck('shipment_id');
                foreach ($shipment_ids as  $shipment_id) {
                    $shipment = Shipment::where('id', $shipment_id)->first();
                    $model->fill($request['missionLocation']);
                    $model->mission_id = $mission->id;
                    $model->mission_status_id = $mission->status_id;
                    $model->shipment_id = $shipment->id;
                    $model->shipment_status_id = $shipment->status_id;
                    if (!$model->save()) {
                        throw new \Exception();
                    }
                }

                return response()->json('Status Changed Successfully!');
            }else
                return response()->json($status);
        }else{
            return response()->json('Not Authorized');
        }
    }
}