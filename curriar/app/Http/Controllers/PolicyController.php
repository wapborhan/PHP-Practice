<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Policy;

class PolicyController extends Controller
{

    public function index($type)
    {
        $policy = Policy::where('name', $type)->first();
        return view('policies.index', compact('policy'));
    }

    //updates the policy pages
    public function store(Request $request){
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $policy = Policy::where('name', $request->name)->first();
        $policy->name = $request->name;
        $policy->content = $request->content;
        $policy->save();

        flash(translate($request->name.' updated successfully'));
        return back();
    }
}
