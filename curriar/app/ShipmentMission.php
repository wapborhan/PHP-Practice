<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentMission extends Model
{
    protected $table = 'shipment_mission';
    protected $guarded = [];


    static public function check_if_shipment_is_assigned_to_mission($shipment_id,$type)
    {
        $type_missions = Mission::where('type',$type)->pluck('id');
        return Self::where('shipment_id',$shipment_id)->whereIn('mission_id',$type_missions)->count();
    }
    public function shipment(){
      return $this->belongsTo('App\Shipment','shipment_id');
    }

    public function mission(){
      return $this->hasOne('App\Mission', 'id' , 'mission_id');
    }
} 

