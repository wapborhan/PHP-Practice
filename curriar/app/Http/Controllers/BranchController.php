<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Http\Helpers\UserRegistrationHelper;
use App\User;
use App\UserBranch;
use DB;
class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::where('is_archived',0)->paginate(15);
        return view('backend.branchs.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.branchs.create');
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
        $request->validate([
            'Branch.email' => 'required|unique:users,email',
        ]);
        try{	
			DB::beginTransaction();
			$model = new Branch();
			
			
			$model->fill($_POST['Branch']);
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
			$userRegistrationHelper->setUserType("branch");
			$response = $userRegistrationHelper->save();
			if(!$response['success']){
				throw new \Exception($response['error_msg']);
			}
			$UserBranch = new UserBranch();
			$UserBranch->user_id = $response['user_id'];
			$UserBranch->Branch_id = $model->id;
			if (!$UserBranch->save()){
				throw new \Exception();
			}
			DB::commit();
            flash(translate("Branch added successfully"))->success();
            $route = 'admin.branchs.index';
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
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $branch = Branch::where('id', $id)->first();
        $shipments = \App\Shipment::where('branch_id', $id)->paginate(15);
        if($branch != null){
            return view('backend.branchs.show',compact('branch','shipments'));
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
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $branch = Branch::where('id', $id)->first();
        if($branch != null){
            return view('backend.branchs.edit',compact('branch'));
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
    public function update(Request $request, $Branch)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        try{	
			DB::beginTransaction();
			$model = Branch::find($Branch);
			
			
			$model->fill($_POST['Branch']);
			$model->code = -1;
            $model->img = $_POST['img'];
	      
			if (!$model->save()){
				throw new \Exception();
			}
			$model->code = $model->id;
			if (!$model->save()){
				throw new \Exception();
			}
            $userId = $model->UserBranch->user_id;
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
            flash(translate("Branch updated successfully"))->success();
            $route = 'admin.branchs.index';
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
    public function destroy($Branch)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
   
        $model = Branch::findOrFail($Branch);
        $user = UserBranch::where('branch_id',$model->id)->first();
        if($user != null)
        {
            $branch_user = User::find($user->user_id);
            $branch_user->delete();
        }
        $model->is_archived = 1;
        if($model->save()){
            flash(translate('Branch has been deleted successfully'))->success();
            return redirect()->back();
        }
        return back();
    }
}
