<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('backend.sms.index',compact('users'));
    }

    //send message to multiple users
    public function send(Request $request)
    {
        foreach ($request->user_phones as $key => $phone) {
            sendSMS($phone, env('APP_NAME'), $request->msg);
        }

        flash(__('SMS has been sent.'))->success();
        return redirect()->route('admin.dashboard');
    }
}
