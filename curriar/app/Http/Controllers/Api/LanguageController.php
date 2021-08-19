<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Resources\UserCollection;
use App\Http\Helpers\ApiHelper;
use App\User;
use App\Language;

class LanguageController extends Controller
{

    public function getLanguages(Request $request)
    {
        $apihelper = new ApiHelper();
        $user = $apihelper->checkUser($request);

        if($user){
            $languages = Language::get();
            return response()->json($languages);
        }else{
            return response()->json('Not Authorized');
        }
    }
}