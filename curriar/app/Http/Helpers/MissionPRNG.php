<?php

namespace App\Http\Helpers;
use Illuminate\Support\Facades\DB;
use App\Mission;

class MissionPRNG{

    private $key; //Key that will be generated
    private $min; //Min of random numbers
    private $max; //Max of random numbers

    private function checkExist()
    {
        $count = Mission::where('otp',$this->key)->count();
        return ($count > 0)?true:false;
    }
    private function generatePRNG()
    {
        $this->min = 100000;
        $this->max = 999999;
        return mt_rand($this->min,$this->max);
    }

    private function createKey()
    {
        $this->key = $this->generatePRNG();
        $exist = $this->checkExist();
        return (!$exist)?$this->key:$this->createKey();
    }

    static public function get()
    {
        $instanse = new MissionPRNG;
        return $instanse->createKey();
    }

}
