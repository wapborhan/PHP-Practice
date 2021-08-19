<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Captain;
use App\Http\Helpers\UserRegistrationHelper;
use App\User;
use App\UserCaptain;
use Auth;
use DB;
use App\Branch;
use App\Events\AddCaptain;

class CaptainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->user_type == 'branch'){
            $captains = Captain::where('is_archived',0)->where('branch_id', Auth::user()->userBranch->branch_id)->paginate(15);
        }else{
            $captains = Captain::where('is_archived',0)->paginate(15);
        }
        return view('backend.captains.index', compact('captains'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branchs = Branch::where('is_archived',0)->get();
        return view('backend.captains.create',compact('branchs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Captain.email' => 'required|unique:users,email',
        ]);
        try{	
			DB::beginTransaction();
			$model = new Captain();
			
			
			$model->fill($_POST['Captain']);
			$model->code = -1;
            $model->img = $_POST['img'];
	      
			if (!$model->save()){
				throw new \Exception();
			}
			$model->code = $model->id;
			if (!$model->save()){
				throw new \Exception();
			}
			$userRegistrationHelper = new UserRegistrationHelper();
			$userRegistrationHelper->setEmail($model->email); 
			$userRegistrationHelper->setName($model->name);
			$userRegistrationHelper->setApiToken();
			if ($_POST['User']['password'] != '' || $_POST['User']['password'] != null){
				$userRegistrationHelper->setPassword($_POST['User']['password']);
			}else{
				$userRegistrationHelper->generatePassword();
			}
			$userRegistrationHelper->setRoleID(UserRegistrationHelper::MAINCLIENT);
			$userRegistrationHelper->setUserType("captain");
			$response = $userRegistrationHelper->save();
			if(!$response['success']){
				throw new \Exception($response['error_msg']);
			}
			$userCaptain = new UserCaptain();
			$userCaptain->user_id = $response['user_id'];
			$userCaptain->Captain_id = $model->id;
			if (!$userCaptain->save()){
				throw new \Exception();
			}
            event(new AddCaptain($model));
			DB::commit();
            flash(translate("Captain added successfully"))->success();
            $route = 'admin.captains.index';
            return execute_redirect($request,$route);
		}catch(\Exception $e){
			DB::rollback();
			print_r($e->getMessage());
			exit;
			
			flash(translate("Error"))->error();
            return back();
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
        $captain = Captain::where('id', $id)->first();
        $shipments  = \App\Shipment::where('captain_id', $captain->id)->paginate(15);
        if($captain != null){
            return view('backend.captains.show',compact('captain', 'shipments'));
        }
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
        $captain = Captain::where('id', $id)->first();
        $branchs = Branch::where('is_archived',0)->get();
        if($captain != null){
            return view('backend.captains.edit',compact('captain','branchs'));
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
    public function update(Request $request, $captain)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        try{	
			DB::beginTransaction();
			$model = Captain::find($captain);
			
			
			$model->fill($_POST['Captain']);
			$model->code = -1;
            $model->img = $_POST['img'];
	      
			if (!$model->save()){
				throw new \Exception();
			}
			$model->code = $model->id;
			if (!$model->save()){
				throw new \Exception();
			}
            $userId = $model->userCaptain->user_id;
			$userRegistrationHelper = new UserRegistrationHelper($userId);
			$userRegistrationHelper->setEmail($model->email); 
			$userRegistrationHelper->setName($model->name);
			$userRegistrationHelper->setApiToken();
			if ($_POST['User']['password'] != '' || $_POST['User']['password'] != null){
				$userRegistrationHelper->setPassword($_POST['User']['password']);
			}
			$userRegistrationHelper->setRoleID(UserRegistrationHelper::MAINCLIENT);
			$response = $userRegistrationHelper->save();
			if(!$response['success']){
				throw new \Exception($response['error_msg']);
			}
			
			DB::commit();
            flash(translate("Captain updated successfully"))->success();
            $route = 'admin.captains.index';
            return execute_redirect($request,$route);
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
    public function destroy($captain)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
   
        $model = Captain::findOrFail($captain);
        $user = UserCaptain::where('captain_id',$model->id)->first();
        if($user != null)
        {
            $branch_user = User::find($user->user_id);
            $branch_user->delete();
        }
        $model->is_archived = 1;
        if($model->save()){
            flash(translate('Driver has been deleted successfully'))->success();
            return redirect()->back();
        }
        return back();
    }
}
