<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Subscriber;
use Mail;
use App\Mail\EmailManager;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $subscribers = Subscriber::all();
        return view('backend.marketing.newsletters.index', compact('users', 'subscribers'));
    }

    public function send(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        if (env('MAIL_USERNAME') != null) {
            //sends newsletter to selected users
        	if ($request->has('user_emails')) {
                foreach ($request->user_emails as $key => $email) {
                    $array['view'] = 'emails.newsletter';
                    $array['subject'] = $request->subject;
                    if (!filter_var(env('MAIL_USERNAME'), FILTER_VALIDATE_EMAIL)) {
                        $array['from'] = env('MAIL_FROM_ADDRESS');
                    }else{
                        $array['from'] = env('MAIL_USERNAME');
                    }
                    $array['content'] = $request->content;

                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                    } catch (\Exception $e) {
                        //dd($e);
                    }
            	}
            }

            //sends newsletter to subscribers
            if ($request->has('subscriber_emails')) {
                foreach ($request->subscriber_emails as $key => $email) {
                    $array['view'] = 'emails.newsletter';
                    $array['subject'] = $request->subject;
                    if (!filter_var(env('MAIL_USERNAME'), FILTER_VALIDATE_EMAIL)) {
                        $array['from'] = env('MAIL_FROM_ADDRESS');
                    }else{
                        $array['from'] = env('MAIL_USERNAME');
                    }
                    $array['content'] = $request->content;

                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                    } catch (\Exception $e) {
                        //dd($e);
                    }
            	}
            }
        }
        else {
            flash(translate('Please configure SMTP first'))->error();
            return back();
        }

    	flash(translate('Newsletter has been send'))->success();
    	return redirect()->route('admin.dashboard');
    }

    public function testEmail(Request $request){
        $array['view'] = 'emails.newsletter';
        $array['subject'] = "SMTP Test";
        if (!filter_var(env('MAIL_USERNAME'), FILTER_VALIDATE_EMAIL)) {
            $array['from'] = env('MAIL_FROM_ADDRESS');
        }else{
            $array['from'] = env('MAIL_USERNAME');
        }
        $array['content'] = "This is a test email.";

        try {
            /*********************
             * Sample for using Notification
             * Params:
             *  id: the receiver id
             *  title: the notification, which will appear as email subject and full notification on system and also will be sent via SMS
             *  content: the message content which can be HTML and it will be used in the email
             *  type: [add_shipment, update_shipment, administration_message, general as default]
             *  icon: the icon that will appear for the notification
             */

            /*
            $data = array(
                'sender'    =>  \Auth::user(),
                'message'   =>  array(
                    'subject'   =>  $request->title,
                    'content'   =>  $request->content,
                    'url'       =>  $request->url,
                ),
                'icon'      =>  'flaticon2-bell-4',
                'type'      =>  $request->type,
            );
            \App\User::find($request->id)->notify(new \App\Notifications\GlobalNotification($data, ['system']));
            */

            Mail::to($request->email)->queue(new EmailManager($array));
        } catch (\Exception $e) {
            dd($e);
        }

        flash(translate('An email has been sent.'))->success();
        return back();
    }
}
