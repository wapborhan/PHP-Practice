<?php


namespace App\Channels;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Env;


class SmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return bool
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);

        //SEND HERE

        return true;

    }

}
