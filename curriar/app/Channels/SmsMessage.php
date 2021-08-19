<?php


namespace App\Channels;
use Illuminate\Support\Arr;


class SmsMessage
{
    public $content;

    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

}
