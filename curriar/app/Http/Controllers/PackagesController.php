<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use App\Http\Helpers\UserRegistrationHelper;
use DB;
use App\User;
class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::paginate(15);
        return view('backend.shipments.index-package', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shipments.create-package');
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
            $check = Package::where('name',$_POST['Package']['name'])->first();
            if($check != null)
            {
                flash(translate("This package is created before"))->error();
                return back();
            }
			$model = new Package();
			
			
			$model->fill($_POST['Package']);
	      
			if (!$model->save()){
				throw new \Exception();
			}
			
			DB::commit();
            flash(translate("Package added successfully"))->success();
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
        if($request->is('api/*')){
            $token = $request->header('token');
            if(isset($token))
            {
                $user = User::where('api_token',$token)->first();

                if(!$user)
                {
                    return response()->json('Not Authorized');
                }
                $packages = Package::get();
                return response()->json($packages);
            }else{
                return response()->json('Not Authorizedd');
            }      
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
        $package = Package::where('id', $id)->first();
        if($package != null){
            return view('backend.shipments.edit-package',compact('package'));
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
    public function update(Request $request, $package)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        try{	
			DB::beginTransaction();
            $check = Package::where('name',$_POST['Package']['name'])->whereNotIn('id',[$package])->first();
            if($check != null)
            {
                flash(translate("This package is created before"))->error();
                return back();
            }
			$model = Package::find($package);
			
			
			$model->fill($_POST['Package']);
		
			if (!$model->save()){
				throw new \Exception();
			}
			
			
			DB::commit();
            flash(translate("Package updated successfully"))->success();
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
    public function destroy($package)
    {
   
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $model = Package::findOrFail($package);
        
        if($model->delete()){
            flash(translate('Package has been deleted successfully'))->success();
            return redirect()->back();
        }
        return back();
    }
}
