<?php

namespace App\Http\Helpers;

use Illuminate\Http\Request;
use App\User;

class ApiHelper{

 
    public function checkUser(Request $request)
    {
        if($request->is('api/*')){
            $token = $request->header('token');
            if(isset($token))
            {
                $user = User::where('api_token',$token)->first();

                if(!$user)
                {
                    //return response()->json('Not Authorized');
                    return false;
                }
                return $user;
            }else{
                //return response()->json('Not Authorizedd');
                return false;
            }      
        }
    }


}