<?php

namespace App\Http\Helpers;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRegistrationHelper{
	private $user;
	CONST MAINCLIENT = 1;
	CONST BRANCHCLIENT = 2;
	CONST BRANCH = 3;
	CONST CAPTAIN = 4;
	CONST PARTNER = 8;
	public function __construct($id = null) {

		if($id == null)
		{
			$this->user = new User();
		}else{

			$this->user = User::find($id);

		}
	}

	public function setFirstName($first_name){
		$this->user->first_name = $first_name;
	}

	public function setLastName($last_name){
		$this->user->last_name = $last_name;
	}

	public function setEmail($email){

		$this->user->email = $email;

	}

	public function setPassword($password){
		$this->user->password = Hash::make($password);
	}

	public function generatePassword(){
		$this->user->password = Hash::make("newuser");
	}

	public function setUserType($type){
		$this->user->user_type = $type;
	}

	public function setRoleID($id){
		$this->user->role_id = $id;
	}

	public function setApiToken(){
		$token = Str::random(60);
		$this->user->api_token = hash('sha256', $token);
	}

	public function setApiTokenGenerator(){
		$token = Str::random(60);
		$this->user->api_token = hash('sha256', $token);
		if($this->user->save())
		{
			return $this->user->api_token;
		}
	}
	public function setName($name){
		$presetName = ["Generated","User"];

		$counter = 0;
		$this->user->name = $name;

	}

	public function save(){

		$response = array();
		$response['success'] = true;
		$response['error_msg'] = '';
		try{
			if(!$this->user->save()){
				throw new \Exception();
			}
			$response['user_id'] = $this->user->id;
		}catch(\Exception $e){
			$response['success'] = false;
			$response['error_msg'] = "UserRegestirationHelper: ".$e->getMessage();
		}

		return $response;
	}
}