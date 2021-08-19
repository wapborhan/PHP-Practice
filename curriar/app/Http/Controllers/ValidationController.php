<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\UserRegistrationHelper;
use App\User;
use Auth;
use DB;


class ValidationController extends Controller
{
    public function ajax_check_email(Request $request)
    {
        $isUniqueEmail = true;
        $type = $_GET['type'];
        $email = $_GET[$type];
        $user = User::where('email', $email)->first();
        if($user != null){
            $isUniqueEmail =  false;
        }
        return json_encode(array(
            'valid' => $isUniqueEmail,
        ));
    }
}