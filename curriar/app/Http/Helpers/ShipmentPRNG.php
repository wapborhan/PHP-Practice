<?php

namespace App\Http\Helpers;
use Illuminate\Support\Facades\DB;
use App\Shipment;
use App\ShipmentSetting;

class ShipmentPRNG{

    private $key; //Key that will be generated
    private $min = 0; //Min of random numbers
    private $max = 0; //Max of random numbers

    private function checkExist()
    {
        $count = Shipment::where('code',$this->key)->count();
        return ($count > 0)?true:false;
    }
    private function generatePRNG()
    {
        $code = '';
        for($n = 0; $n < ShipmentSetting::getVal('shipment_code_count'); $n++){
            $code .= '0';
            $this->max = $this->max.'9';
        }
        $rand   =  rand($this->min, (int)$this->max);
        $code   =  substr($code, 0, -strlen($rand));
        echo ShipmentSetting::getVal('shipment_code_count');
        return $code.$rand;
    }

    private function createKey()
    {
        $this->key = $this->generatePRNG();
        $exist = $this->checkExist();
        return (!$exist)?$this->key:$this->createKey();
    }

    static public function get()
    {
        $instanse = new ShipmentPRNG;
        return $instanse->createKey();
    }

}
