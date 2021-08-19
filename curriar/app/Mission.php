<?php

namespace App;

use App\Http\Helpers\TransactionHelper;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $guarded = [];

    //Types of Missions
    CONST PICKUP_TYPE = 1;
    CONST DELIVERY_TYPE = 2;
    CONST RETURN_TYPE = 3;
    CONST SUPPLY_TYPE = 4;
    CONST TRANSFER_TYPE = 5;

    //Status of Missions
    CONST REQUESTED_STATUS = 1;
    CONST APPROVED_STATUS = 2;
    CONST DONE_STATUS = 3;
    CONST CLOSED_STATUS = 4;
    CONST RECIVED_STATUS = 5;

    static public function status_info()
    {
       $array = [
           ['status' => Self::REQUESTED_STATUS,
            'text' => translate('Requested'),
            'route_name' => 'admin.missions.requested.index',
            'route_url'=>'requested',
            'optional_params'=>'/{type?}',
            'color'=>'info',
            'user_role'=>['admin','customer','branch'],
            'permissions'=>1009],

            ['status' => Self::APPROVED_STATUS,
            'text' => translate('Assigned & Approved'),
            'route_name' => 'admin.missions.approved.index',
            'route_url'=>'approved',
            'optional_params'=>'/{type?}',
            'color'=>'primary',
            'user_role'=>['admin','customer','captain','branch'],
            'permissions'=>1010],

            ['status' => Self::RECIVED_STATUS,
            'text' => translate('Recived'),
            'route_name' => 'admin.missions.recived.index',
            'route_url'=>'recived',
            'optional_params'=>'/{type?}',
            'color'=>'primary',
            'user_role'=>['admin','customer','captain','branch'],
            'permissions'=>1011],

            ['status' => Self::DONE_STATUS,
            'text' => translate('Done'),
            'route_name' => 'admin.missions.done.index',
            'route_url'=>'done',
            'optional_params'=>'/{type?}',
            'color'=>'success',
            'user_role'=>['admin','customer','captain','branch'],
            'permissions'=>1012],

            ['status' => Self::CLOSED_STATUS,
            'text' => translate('Closed'),
            'route_name' => 'admin.missions.closed.index',
            'route_url'=>'closed',
            'optional_params'=>'/{type?}',
            'color'=>'danger',
            'user_role'=>['admin','customer','branch'],
            'permissions'=>1013],
       ];
       return $array;
    }

    public function captain(){
		return $this->hasOne('App\Captain', 'id' , 'captain_id');
	}
    public function client(){
		return $this->hasOne('App\Client', 'id' , 'client_id');
	}
    public function to_branch(){
		return $this->hasOne('App\Branch', 'id' , 'to_branch_id');
	}

    public function shipment_mission(){
		return $this->hasMany('App\ShipmentMission', 'mission_id' , 'id');
	}

    public function shipment_mission_by_shipment_id($shipment_id){
		return $this->hasMany('App\ShipmentMission', 'mission_id' , 'id')->where('shipment_id',$shipment_id)->get()->first();
	}

    public function shipment_mission_by_payment_type($payment_integration_id,$payment_type){
		return $this->hasMany('App\ShipmentMission', 'mission_id' , 'id')->with('shipment', function ($query) use ($payment_integration_id,$payment_type) {
            $query->where('payment_integration_id',$payment_integration_id)->where('payment_type',$payment_type);
        })->get();
	}

    public function getStatus()
     {
        $result = null;
        foreach(Self::status_info() as $status)
        {
            $status_id = $this->status_id;
            $result = (isset($status['status']) && $status['status'] == $status_id) ?$status['text']: null;
            if($result != null){
                return $result;
            }
        }
        
        return $result;
     }
     static public function getStatusByStatusId($status_id_attr)
     {
        $result = null;
        foreach(Self::status_info() as $status)
        {
            $status_id = $status_id_attr;
            $result = (isset($status['status']) && $status['status'] == $status_id) ?$status['text']: null;
            if($result != null){
                return $result;
            }
        }
        
        return $result;
     }

     static public function getStatusColor($status_id_attr)
     {
        $result = "text-danger";
        foreach(Self::status_info() as $status)
        {
            $status_id = $status_id_attr;
            $result = (isset($status['status']) && $status['status'] == $status_id) ?$status['color']: null;
            if($result != null){
                return $result;
            }
        }
        
        return $result;
     }

     static public function getStatusByRoute($route_name)
     {
        $result = null;
        foreach(Self::status_info() as $status)
        {
            $result = (isset($status['route_name']) && $status['route_name'] == $route_name) ?$status['status']: null;
            return $result;
        }
        return $result;
     }

     public function getTypeAttribute($value)
     {
         if($value == Self::DELIVERY_TYPE)
         {
             return translate('Delivery');
         }elseif($value == Self::PICKUP_TYPE)
         {
            return translate('Pickup');
         }elseif($value == Self::RETURN_TYPE)
         {
            return translate('Return');
         }elseif($value == Self::SUPPLY_TYPE)
         {
            return translate('Supply');
         }elseif($value == Self::TRANSFER_TYPE)
         {
            return translate('Transfer');
         }
     }

     static public function getType($value)
     {
         if($value == Self::DELIVERY_TYPE)
         {
             return translate('Delivery');
         }elseif($value == Self::PICKUP_TYPE)
         {
            return translate('Pickup');
         }elseif($value == Self::RETURN_TYPE)
         {
            return translate('Return');
         }elseif($value == Self::SUPPLY_TYPE)
         {
            return translate('Supply');
         }elseif($value == Self::TRANSFER_TYPE)
         {
            return translate('Transfer');
         }else
         {
             return null;
         }
     }

     
}
