<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Client;
use App\Http\Helpers\UserRegistrationHelper;
use App\User;
use App\UserClient;
use DB;
use Auth;
use App\BusinessSetting;
use App\Events\AddClient;
use App\AddressClient;
use App\ClientPackage;
use Carbon\Carbon;
use App\Package;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::where('is_archived',0)->paginate(15);
        return view('backend.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try{	
			DB::beginTransaction();
			$model = new Client();
			
			
			$model->fill($_POST['Client']);
			$model->code = -1;
            $model->img = $_POST['img'];
	      
			if (!$model->save()){
				throw new \Exception();
			}
            $auth_user = Auth::user();
            if($auth_user->user_type == 'admin'){
                $model->created_by_type = 'admin';
                $model->created_by = $auth_user->id;
            }elseif($auth_user->user_type == 'staff'){
                $model->created_by_type = 'staff';
                $model->created_by = $auth_user->staff->id;
            }elseif($auth_user->user_type == 'branch'){
                $model->created_by_type = 'branch';
                $model->created_by =  $auth_user->userBranch->branch_id;
            }
			$model->code = $model->id;
			if (!$model->save()){
				throw new \Exception();
			}

            if (isset($request->package_id)) {
                if (!empty($request->package_id)) {

                    foreach ($request->package_id as $key => $package) {
                        $client_package = new ClientPackage();

                        $client_package->client_id    = $model->id;
                        $client_package->package_id   = $package;
                        $client_package->package_name = Package::select('name')->where('id',$package)->first();
                        $client_package->package_name = $client_package->package_name->name;
                        $client_package->package_cost = $request->package_extra[$key];
                        
                        if (!$client_package->save()) {
                            throw new \Exception();
                        }
                    }
                }
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
			$response = $userRegistrationHelper->save();
			if(!$response['success']){
				throw new \Exception($response['error_msg']);
			}
			$userClient = new UserClient();
			$userClient->user_id = $response['user_id'];
			$userClient->client_id = $model->id;
			if (!$userClient->save()){
				throw new \Exception();
			}

            if (isset($request->address)) {
                if (!empty($request->address)) {
                    foreach ($request->address as $address) {
                        
                        if(isset($address['address']) && $address['address'] != null )
                        {
                            $client_address = new AddressClient();
                            $client_address->fill($address);
                            $client_address->client_id = $model->id;
                            
                            if (!$client_address->save()) {
                                throw new \Exception();
                            }
                        }
                    }
                }
            }

            event(new AddClient($model));
			DB::commit();
            flash(translate("Client added successfully"))->success();
            $route = 'admin.clients.index';
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
     * 
     * Show the form for register public client.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('backend.clients.register');
    }

    /**
     * Save register data in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try{
			$validator = Validator::make($request->all(), [
				'name' => 'required',
				'password' => 'required|required_with:password_confirmation|same:password_confirmation',
				'password_confirmation' => 'required',
				'email' => ['email','required','unique:users'],
				'mobile' => 'required',
				'condotion_agreement' => 'required',
			]);

		        if ($validator->fails()) {
			    return back()
				->withErrors($validator)
				->withInput();
		        }
		
			DB::beginTransaction();
			$model = new Client();
			
			
			$model->name = $request->name;
			$model->email = $request->email;
			$model->responsible_mobile = $request->responsible_mobile;
			$model->code = -1;
	      
			if (!$model->save()){
				throw new \Exception();
			}

            $model->created_by_type = 'client';
            $model->created_by      = -1;
            $model->pickup_cost     = \App\ShipmentSetting::getVal('def_pickup_cost');
            $model->supply_cost     = \App\ShipmentSetting::getVal('def_supply_cost');
			$model->code            = $model->id;
			if (!$model->save()){
				throw new \Exception();
			}
			$userRegistrationHelper = new UserRegistrationHelper();
			$userRegistrationHelper->setEmail($model->email); 
			$userRegistrationHelper->setName($model->name);
			$userRegistrationHelper->setApiToken();
            $userRegistrationHelper->setPassword($request->password);
			$userRegistrationHelper->setRoleID(UserRegistrationHelper::MAINCLIENT);
			$response = $userRegistrationHelper->save();
			if(!$response['success']){
				throw new \Exception($response['error_msg']);
			}
			$userClient = new UserClient();
			$userClient->user_id = $response['user_id'];
			$userClient->client_id = $model->id;
			if (!$userClient->save()){
				throw new \Exception();
			}

            event(new AddClient($model));
			DB::commit();
            
            flash(translate("Your account has been created successfully"))->success();

            Auth::loginUsingId($response['user_id']);

            $route = 'admin.dashboard';
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
        $client = Client::where('id', $id)->first();
        $shipments = \App\Shipment::where('client_id', $id)->paginate(15);
        if($client != null){
            return view('backend.clients.show',compact('client','shipments'));
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
        $client = Client::where('id', $id)->first();
        if($client != null){
            return view('backend.clients.edit',compact('client'));
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
    public function update(Request $request, $client)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        try{	
			DB::beginTransaction();
			$model = Client::find($client);
			
			
			$model->fill($_POST['Client']);
			$model->code = -1;
            $model->img = $_POST['img'];
	      
			if (!$model->save()){
				throw new \Exception();
			}
			$model->code = $model->id;
			if (!$model->save()){
				throw new \Exception();
			}

            if (isset($request->package_id)) {
                if (!empty($request->package_id)) {

                    foreach ($request->package_id as $key => $package) {
                        $client_package = ClientPackage::where('client_id',$client)->where('package_id' , $package)->first();
                        $client_package->package_cost = $request->package_extra[$key];
                        
                        if (!$client_package->save()) {
                            throw new \Exception();
                        }
                    }
                }
            }

            $userId = $model->userClient->user_id;
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

            $updated_address_ids = array();
            foreach($request->address as $address)
            {
                if(isset($address['addressess_id']) && $address['addressess_id'] != null)
                {
                    $updated_address_ids[] = $address['addressess_id'];
                }

                if(isset($address['address']) && $address['address'] != null && $address['addressess_id'] != null)
                {   
                    $updateAdress = $address;
                    unset($updateAdress['addressess_id']);

                    $client_address = AddressClient::where('id' , $address['addressess_id'])->first();
                    $client_address->fill($updateAdress);
                    $client_address->client_id = $client;
                    
                    if (!$client_address->save()) {
                        throw new \Exception();
                    }

                    $updated_address_ids[] = $client_address->id;
                }

                if(isset($address['address']) && $address['address'] != null && $address['addressess_id'] == null)
                {
                    $newAdress = $address;
                    unset($newAdress['addressess_id']);

                    $client_address = new AddressClient();
                    $client_address->fill($newAdress);
                    $client_address->client_id = $client;
                    
                    if (!$client_address->save()) {
                        throw new \Exception();
                    }

                    $updated_address_ids[] = $client_address->id;
                }
            }
            $deleteOldAddressess = AddressClient::where('client_id', $client)->whereNotIn('id',$updated_address_ids)->delete();
			
			DB::commit();
            flash(translate("Client updated successfully"))->success();
            $route = 'admin.clients.index';
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
    public function destroy($client)
    {
   
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $model = Client::findOrFail($client);
        $user = UserClient::where('client_id',$model->id)->first();
        if($user != null)
        {
            $branch_user = User::find($user->user_id);
            $branch_user->delete();
        }
        $model->is_archived = 1;
        if($model->save()){
            flash(translate('Customer has been deleted successfully'))->success();
            return redirect()->back();
        }
        return back();
    }

    public function addNewAddress(Request $request)
    {
        $client_address = new AddressClient();
        $client_address->client_id                 = $request->client_id;
        $client_address->address                   = $request->address;
        $client_address->country_id                = $request->country;
        $client_address->state_id                  = $request->state;
        if(isset($request->area)){
            $client_address->area_id               = $request->area;
        }

        $googel_map = BusinessSetting::where('type', 'google_map')->first();
        if($googel_map->value == 1){
            $client_address->client_street_address_map = $request->client_street_address_map;
            $client_address->client_lat                = $request->client_lat;
            $client_address->client_lng                = $request->client_lng;
            $client_address->client_url                = $request->client_url;
        }
        
        if (!$client_address->save()) {
            throw new \Exception();
        }

        $client_id  = $request->client_id;
        $addressess = AddressClient::where('client_id', $client_id)->get();
        return response()->json($addressess);
    }

    public function getOneAddress(Request $request)
    {
        $address_id = $_GET['address_id'];
        $address = AddressClient::where('id', $address_id)->get();
        return response()->json($address);
    }
    
    public function addNewAddressAPI(Request $request)
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
                $addresses = $this->addNewAddress($request);
                return response()->json($addressess);    
            }else{
                return response()->json('Not Authorizedd');
            }      
        }
    }

    public function getAddressesAPI(Request $request)
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
                $addresses = AddressClient::where('client_id', $request->client_id)->get();
                return response()->json($addressess);    
            }else{
                return response()->json('Not Authorizedd');
            }      
        }
        
    }
}
