<?php

namespace App\Http\Controllers;

use App\Captain;
use App\Http\Controllers\Controller;
use App\Http\Helpers\MissionActionHelper;
use App\Http\Helpers\MissionStatusManagerHelper;
use App\Http\Helpers\TransactionHelper;
use App\Http\Helpers\StatusManagerHelper;
use App\Mission;
use App\Reason;
use App\MissionReason;
use App\BusinessSetting;
use App\Shipment;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Events\ApproveMission;
use App\Events\AssignMission;
use App\Events\UpdateMission;
use App\Events\MissionAction;
use App\User;

class MissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function statusIndex($status,$type=null)
    {
        if(Auth::user()->user_type == 'customer'){
            $missions = Mission::where('status_id',$status)->where('client_id',Auth::user()->userClient->client_id);
        }elseif(Auth::user()->user_type == 'captain'){
            $missions = Mission::where('status_id',$status)->where('captain_id',Auth::user()->userCaptain->captain_id);
        // }elseif(Auth::user()->user_type == 'branch'){
        //     $missions = Mission::where('status_id',$status)->where('to_branch_id',Auth::user()->userBranch->branch_id);
        }else{
            $missions = Mission::where('status_id',$status);
        }
        if($type !=null)
        {
            $missions = $missions->where('type',$type);
        }
        $missions = $missions->orderBy('id','DESC')->paginate(20);
        
        $show_due_date = ($status == Mission::APPROVED_STATUS) ? true : false;

        $actions = new MissionActionHelper();
        $actions = $actions->get($status,$type);
        $page_name = Mission::getStatusByStatusId($status)." ".Mission::getType($type);
        
        return view('backend.missions.index',compact('missions','actions','page_name','type','status','show_due_date'));
    }

    public function change(Request $request,$to,$fromApi = false)
    {
        if(isset($request->checked_ids))
        {
            $mission = Mission::where('id',$request->checked_ids[0])->first();

            $params = array();

            if($to == Mission::DONE_STATUS)
            {
                if(isset($request->amount) && (in_array(Auth::user()->user_type,['admin','branch']) || in_array('1210', json_decode(Auth::user()->staff->role->permissions ?? "[]"))) )
                {
                    $params['amount'] = $request->amount;
                }

                if(isset($request->signaturePadImg))
                {
                    if($request->signaturePadImg == null || $request->signaturePadImg == " ")
                    {
			if($fromApi)
                   	    return "Please Confirm The Signature";
                        flash(translate("Please Confirm The Signature"))->error();
                        return back();
                    }
                    $params['seg_img'] = $request->signaturePadImg;
                }
                if(isset($request->otp))
                {
                    if($request->otp_confirm == null || $request->otp_confirm == " ")
                    {
			if($fromApi)
                   	    return "Please enter OTP of mission";
                        flash(translate("Please enter OTP of mission"))->error();
                        return back();
                    }
                    elseif($mission->otp != $request->otp_confirm )
                    {
			if($fromApi)
                   	    return "Please enter correct OTP";
                        flash(translate("Please enter correct OTP"))->error();
                        return back();
                    }
                    $params['otp'] = $request->otp;
                }

                if(in_array($mission->type,[Mission::getType(Mission::PICKUP_TYPE),Mission::getType(Mission::DELIVERY_TYPE)])){
                    $cash = BusinessSetting::where("type","cash_payment")->get()->first();
                    $payment_method_id = $cash->id;
                    if($mission->type == Mission::getType(Mission::PICKUP_TYPE)){
                        $payment_type = Shipment::PREPAID;
                        $mission = Mission::where('id',$request->checked_ids[0])->where('type',Mission::PICKUP_TYPE)
                                    ->with('shipment_mission')->get()->first();
                        $shipment_ids = $mission->shipment_mission->pluck('shipment_id');
                        
                    }elseif($mission->type == Mission::getType(Mission::DELIVERY_TYPE)){
                        $payment_type = Shipment::POSTPAID;
                        $mission = Mission::where('id',$request->checked_ids[0])->where('type',Mission::DELIVERY_TYPE)
                                    ->with('shipment_mission')->get()->first();
                        $shipment_ids = $mission->shipment_mission->pluck('shipment_id');
                    }
                    $shipments = Shipment::whereIn("id",$shipment_ids)->where('payment_method_id',$payment_method_id)->where('payment_type',$payment_type)->get();
                    foreach ($shipments as $shipment) {
                        $payment = new Payment();
                        $payment->shipment_id = $shipment->id;
                        $payment->seller_id = $shipment->client_id;
                        $payment->amount = $shipment->tax + $shipment->shipping_cost + $shipment->insurance;
                        $payment->payment_method = $shipment->pay->type;
                        $payment->payment_date = Carbon::now()->toDateTimeString();;
                        $payment->save();
                        
                        $shipment->paid = 1;
                        $shipment->save();
                    }
                }
            }

            if($to == Mission::RECIVED_STATUS)
            {
                $params['amount'] = $request->amount;
            }
            
            $action = new MissionStatusManagerHelper();
            $response = $action->change_mission_status($request->checked_ids,$to,null,$params);
            if($response['success'])
            {
                event(new MissionAction($to,$request->checked_ids));
		if($fromApi)
                    return 'success';
                flash(translate("Status Changed Successfully!"))->success();
                return back();
            }
            if($response['error_msg'])
            {
		if($fromApi)
                   return "Somthing Wrong!";
                flash(translate("Somthing Wrong!"))->error();
                return back();
            }
            
        }else
        {
	    if($fromApi)
               return "Please select missions";
            flash(translate("Please select missions"))->error();
            return back();
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mission = Mission::find($id);
        $reasons = Reason::where("type","remove_shipment_from_mission")->get();
        $due_date = ($mission->status_id != Mission::REQUESTED_STATUS) ? $mission->due_date : null;
        $helper = new TransactionHelper();
        $shipment_cost = $helper->calcMissionShipmentsAmount($mission->getOriginal('type'),$mission->id);
        $cod = $helper->calcMissionShipmentsCOD($mission->id);
        
        if($mission->status_id == Mission::APPROVED_STATUS){
            $reschedule = true;
            return view('backend.missions.show',compact('mission','reasons','due_date','reschedule', 'shipment_cost','cod'));
        }else{
            return view('backend.missions.show',compact('mission','reasons','due_date', 'shipment_cost','cod'));
        }
    }
	
    public function getCaptainMissions(Request $request)
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
                if($user->user_type == "customer"){
                    $missions = Mission::where('client_id', $user->userClient->client_id)->get();
                }elseif($user->user_type == "captain"){
                    $missions = Mission::where('captain_id', $user->userCaptain->captain_id)->get();
                }
                return response()->json($missions);
            }else{
                return response()->json('Not Authorizedd');
            }      
        }
    }

    public function changeMissionApi(Request $request)
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
                $status = $this->change($request,$request->to,true);
                if($status == 'success')
                    return response()->json('Status Changed Successfully!');
                else
                    return response()->json($status);    
            }else{
                return response()->json('Not Authorizedd');
            }      
        }
    }
	
    public function approveAndAssign(Request $request,$to)
    {
        // return $request;
        try{	
			DB::beginTransaction();
            $params = array();
            $params['due_data'] = $_POST['Mission']['due_date'];
            $action = new MissionStatusManagerHelper();
            $response = $action->change_mission_status($request->checked_ids,$to,$request['Mission']['captain_id'],$params);
            
            event(new AssignMission($request['Mission']['captain_id'],$request->checked_ids));
            event(new ApproveMission($request->checked_ids));
            DB::commit();
            flash(translate("Mission created successfully"))->success();
            return back();
		}catch(\Exception $e){
			DB::rollback();
			print_r($e->getMessage());
			exit;
			
			flash(translate("Error"))->error();
            return back();
		}
    }

    public function getManifests()
    {
        if(Auth::user()->user_type == 'captain'){
            $captain = Captain::find(Auth::user()->userCaptain->captain_id);
            $missions = Mission::where('captain_id',Auth::user()->userCaptain->captain_id)->whereNotIn('status_id', [\App\Mission::DONE_STATUS, \App\Mission::CLOSED_STATUS])->where('due_date',Carbon::today()->format('Y-m-d'))->orderBy('order')->get();
            return view('backend.missions.manifest-profile',compact('missions','captain'));
        }
        return view('backend.missions.manifests');
    }
    public function ajax_change_order(Request $request)
    {
        $ids = $request['missions_ids'];
        $missions = Mission::whereIn('id', $ids)
        ->orderByRaw("field(id,".implode(',',$ids).")")
        ->get();
        
        foreach ($missions as $key => $mission) {
            $mission->order = $key;
            $mission->save();
        }
        return "Done";
    }

    public function getManifestProfile(Request $request)
    {
        $captain = Captain::find($request->captain_id);
        $due_date   =   $request->manifest_date;
        $missions = Mission::where('captain_id',$request->captain_id)->whereNotIn('status_id', [\App\Mission::DONE_STATUS, \App\Mission::CLOSED_STATUS])->where('due_date',$due_date)->orderBy('order')->get();
        return view('backend.missions.manifest-profile',compact('missions','captain', 'due_date'));
    }

    public function getAmountModel($mission_id)
    {
        $mission = Mission::find($mission_id);
        return view('backend.missions.ajaxed-confirm-amount',compact('mission'));
    }

    public function reschedule(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:missions,id',
            'due_date' => 'required|date',
            'reason' => 'required|exists:reasons,id',
        ]);
        $mission = Mission::find($request->id);
        if($mission->status_id == Mission::APPROVED_STATUS){
            $mission->due_date = $request->due_date;
            $mission->save();
            
            $mission_reason = new MissionReason();
            $mission_reason->mission_id = $mission->id;
            $mission_reason->reason_id = $request->reason;
            $mission_reason->type = "reschedule";
            $mission_reason->save();
            flash(translate("Reschedule set successfully"))->success();
            return back();    
        }else{
            flash(translate("Invalid Link"))->error();
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
