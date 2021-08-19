<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Branch;
use App\Http\Helpers\ApiHelper;

class BranchController extends Controller
{

    public function getBranchs(Request $request)
    {
        $apihelper = new ApiHelper();
        $user = $apihelper->checkUser($request);

        if($user){
            $branches = Branch::where('is_archived',0)->get();
            return response()->json($branches);
        }else{
            return response()->json('Not Authorized');
        }
    }
}