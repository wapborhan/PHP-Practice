<?php

namespace App\Http\Helpers;

use App\ClientShipmentLog;
use App\Mission;
use App\Shipment;
use App\ShipmentLog;
use App\ShipmentMission;
use App\Transaction;
use DB;
class StatusManagerHelper{

    public function change_shipment_status($shipments,$to,$mission_id = null)
    {
        $response = array();
		$response['success'] = 1;
		$response['error_msg'] = '';
		try {
			DB::beginTransaction();
            
            $transaction = new TransactionHelper();
            foreach($shipments as $shipment_id)
            {
                $shipment = Shipment::find($shipment_id);
                if($shipment->status_id == $to)
                {
                    throw new \Exception("Out of status changer scope");
                }
                if($shipment !=null)
                {
                    $oldStatus = $shipment->status_id;
                    $oldClientStatus = $shipment->client_status;

                    //Conditions of change status
                    if($to == Shipment::REQUESTED_STATUS)
                    {
                        $shipment->client_status = Shipment::CLIENT_STATUS_READY;
                        $log = new ClientShipmentLog();
                        $log->from = $oldClientStatus;
                        $log->to = Shipment::CLIENT_STATUS_READY;
                        $log->shipment_id = $shipment->id;
                        $log->created_by = \Auth::user()->id;
                        $log->save();
                        if($mission_id != null && ShipmentMission::check_if_shipment_is_assigned_to_mission($shipment_id,Mission::PICKUP_TYPE) == 0)
                        {
                                $shipment_mission = new ShipmentMission();
                                $shipment_mission->shipment_id = $shipment_id;
                                $shipment_mission->mission_id = $mission_id;
                                $shipment_mission->save();
                        }
                        if($shipment->getOriginal('type') == Shipment::PICKUP)
                        {
                            if($shipment->payment_type == Shipment::PREPAID)
                            {
                                $shipment_cost = $transaction->calculate_shipment_cost($shipment->id);
                                // $transaction->create_shipment_transaction($shipment->id,$shipment_cost,Transaction::CLIENT,$shipment->client_id,Transaction::DEBIT);
                            }
                        }
                    }elseif($to == Shipment::APPROVED_STATUS)
                    {
                        $shipment->client_status = Shipment::CLIENT_STATUS_IN_PROCESSING;
                        $log = new ClientShipmentLog();
                        $log->from = $oldClientStatus;
                        $log->to = Shipment::CLIENT_STATUS_IN_PROCESSING;
                        $log->shipment_id = $shipment->id;
                        $log->created_by = \Auth::user()->id;
                        $log->save();
                    }elseif($to == Shipment::SAVED_STATUS)
                    {
                        $shipment_mission = ShipmentMission::where('mission_id',$mission_id)->where('shipment_id',$shipment->id)->first();
                        $shipment_mission->delete();
                        $shipment->captain_id = null;
                        $shipment->mission_id = null;
                    }elseif($to == Shipment::CAPTAIN_ASSIGNED_STATUS)
                    {
                        $shipment->client_status = Shipment::CLIENT_STATUS_OUT_FOR_DELIVERY;
                        $log = new ClientShipmentLog();
                        $log->from = $oldClientStatus;
                        $log->to = Shipment::CLIENT_STATUS_OUT_FOR_DELIVERY;
                        $log->shipment_id = $shipment->id;
                        $log->created_by = \Auth::user()->id;
                        $log->save();
                        if($mission_id != null)
                        {
                                    $mission = Mission::find($mission_id);
                                    $shipment->captain_id = $mission->captain_id;
                        }
                        
                    }elseif($to == Shipment::RETURNED_STOCK)
                    {
                        $shipment->mission_id = null;
                        $shipment->captain_id = null;
                    }elseif($to == Shipment::RETURNED_STATUS)
                    {
                        $shipment->mission_id = null;
                        $shipment->captain_id = null;
                    }elseif($to == Shipment::DELIVERED_STATUS)
                    {
                        
                        $shipment->client_status = Shipment::CLIENT_STATUS_DELIVERED;
                        $log = new ClientShipmentLog();
                        $log->from = $oldClientStatus;
                        $log->to = Shipment::CLIENT_STATUS_DELIVERED;
                        $log->shipment_id = $shipment->id;
                        $log->created_by = \Auth::user()->id;
                        $log->save();
                    }elseif($to == Shipment::SUPPLIED_STATUS)
                    {
                        $shipment->client_status = Shipment::CLIENT_STATUS_SUPPLIED;
                        $log = new ClientShipmentLog();
                        $log->from = $oldClientStatus;
                        $log->to = Shipment::CLIENT_STATUS_SUPPLIED;
                        $log->shipment_id = $shipment->id;
                        $log->created_by = \Auth::user()->id;
                        $log->save();
                    }
                    
                    $shipment->status_id = $to;
                    if(!$shipment->save())
                    {
                        throw new \Exception("can't change shipment status");
                    }
                    
                    $log = new ShipmentLog();
                    $log->from = $oldStatus;
                    $log->to = $shipment->status_id;
                    $log->shipment_id = $shipment->id;
                    $log->created_by = \Auth::user()->id;
                    $log->save();
                }else
                {
                    throw new \Exception("There is no shipment with this ID");
                }
                
            }
            DB::commit();
        }catch (\Exception $e) {
			//echo $e->getMessage();exit;
			DB::rollback();
			$response['success'] = 0;
			$response['error_msg'] = $e->getMessage();
		}
        return $response;
    }



}