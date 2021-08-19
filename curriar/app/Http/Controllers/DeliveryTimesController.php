<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeliveryTime;
use App\Http\Helpers\UserRegistrationHelper;
use DB;
use App\User;
use App\Http\Helpers\ApiHelper;
class DeliveryTimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $DeliveryTimes = DeliveryTime::paginate(15);
        return view('backend.shipments.index-deliveryTimes', compact('DeliveryTimes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shipments.create-deliveryTimes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        try{	
			DB::beginTransaction();
            $check = DeliveryTime::where('name',$_POST['DeliveryTime']['name'])->first();
            if($check != null)
            {
                flash(translate("This Delivery Time is created before"))->error();
                return back();
            }
			$model = new DeliveryTime();
			
			
			$model->fill($_POST['DeliveryTime']);
	      
			if (!$model->save()){
				throw new \Exception();
			}
			
			DB::commit();
            flash(translate("Delivery Time added successfully"))->success();
            return back();
		}catch(\Exception $e){
			DB::rollback();
			print_r($e->getMessage());
			exit;
			
			flash(translate("Error"))->error();
            return back();
		}
    }

    public function ajaxGetPackages(Request $request)
    {
        $apihelper = new ApiHelper();
        $user = $apihelper->checkUser($request);

        if($user){
            $DeliveryTimes = DeliveryTime::get();
            return response()->json($DeliveryTimes);
        }else{
            return response()->json('Not Authorized');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $DeliveryTime = DeliveryTime::where('id', $id)->first();
        if($DeliveryTime != null){
            return view('backend.shipments.edit-deliveryTimes',compact('DeliveryTime'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $deliveryTime)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        try{	
			DB::beginTransaction();
            $check = DeliveryTime::where('name',$_POST['DeliveryTime']['name'])->whereNotIn('id',[$deliveryTime])->first();
            if($check != null)
            {
                flash(translate("This Delivery Time is created before"))->error();
                return back();
            }
			$model = DeliveryTime::find($deliveryTime);
			
			
			$model->fill($_POST['DeliveryTime']);
		
			if (!$model->save()){
				throw new \Exception();
			}
			
			
			DB::commit();
            flash(translate("Delivery Time updated successfully"))->success();
            return back();
		}catch(\Exception $e){
			DB::rollback();
			print_r($e->getMessage());
			exit;
			
			flash(translate("Error"))->error();
            return back();
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($deliveryTime)
    {
   
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $model = DeliveryTime::findOrFail($deliveryTime);
        
        if($model->delete()){
            flash(translate('Delivery Time has been deleted successfully'))->success();
            return redirect()->back();
        }
        return back();
    }
}
