<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $guarded = [];

    //Shipment Types
    const PICKUP = 1;
    const DROPOFF = 2;

    //Payment Methods
    const CASH_METHOD = 1;
    const PAYPAL_METHOD = 2;

    //Payment Types
    const POSTPAID = 1;
    const PREPAID = 2;

    //Shipments Status Manager
    const SAVED_STATUS = 1;
    const REQUESTED_STATUS = 2;
    const APPROVED_STATUS = 3;
    const CLOSED_STATUS = 4;
    const CAPTAIN_ASSIGNED_STATUS = 5;
    const RECIVED_STATUS = 6;
    const IN_STOCK_STATUS = 7;
    const PENDING_STATUS = 8;
    const DELIVERED_STATUS = 9;
    const SUPPLIED_STATUS = 10;
    const RETURNED_STATUS = 11;
    const RETURNED_ON_SENDER = 12;
    const RETURNED_ON_RECEIVER = 13;
    const RETURNED_STOCK = 14;
    const RETURNED_CLIENT_GIVEN = 15;

    const CLIENT_STATUS_CREATED = 1;
    const CLIENT_STATUS_READY = 2;
    const CLIENT_STATUS_IN_PROCESSING = 3;
    const CLIENT_STATUS_TRANSFERED = 4;
    const CLIENT_STATUS_RECEIVED_BRANCH = 5;
    const CLIENT_STATUS_OUT_FOR_DELIVERY = 6;
    const CLIENT_STATUS_DELIVERED = 7;
    const CLIENT_STATUS_SUPPLIED = 8;

    static public function client_status_info()
    {
        $array = [
            [
                'status' => Self::CLIENT_STATUS_CREATED,
                'text' => translate('Created'),
            ],
            [
                'status' => Self::CLIENT_STATUS_READY,
                'text' => translate('Ready for shipping'),
            ],
            [
                'status' => Self::CLIENT_STATUS_IN_PROCESSING,
                'text' => translate('In Processing'),
            ],
            [
                'status' => Self::CLIENT_STATUS_TRANSFERED,
                'text' => translate('Moving to Branch'),
            ],
            [
                'status' => Self::CLIENT_STATUS_RECEIVED_BRANCH,
                'text' => translate('Received in branch'),
            ],
            [
                'status' => Self::CLIENT_STATUS_OUT_FOR_DELIVERY,
                'text' => translate('Out for delivery'),
            ],
            [
                'status' => Self::CLIENT_STATUS_DELIVERED,
                'text' => translate('Delivered'),
            ],
            [
                'status' => Self::CLIENT_STATUS_SUPPLIED,
                'text' => translate('Supplied'),
            ]
        ];
        return $array;
    }
    public function getClientStatus()
    {
        $result = null;
        foreach (Self::client_status_info() as $status) {
            $status_id = $this->status_id;
            $result = (isset($status['status']) && $status['status'] == $status_id) ? $status['text'] : null;
            if ($result != null) {
                return $result;
            }
        }

        return $result;
    }
    static public function getClientStatusByStatusId($status_id_attr)
    {
        $result = null;
        foreach (Self::client_status_info() as $status) {
            $status_id = $status_id_attr;
            $result = (isset($status['status']) && $status['status'] == $status_id) ? $status['text'] : null;
            if ($result != null) {
                return $result;
            }
        }

        return $result;
    }

    static public function status_info()
    {
        $array = [
            [
                'status' => Self::SAVED_STATUS,
                'text' => translate('Saved'),
                'route_name' => 'admin.shipments.saved.index',
                'permissions' => 1014,
                'route_url' => 'saved',
                'optional_params' => '/{type?}'
            ],

            [
                'status' => Self::REQUESTED_STATUS,
                'text' => translate('Requested'),
                'route_name' => 'admin.shipments.requested.index',
                'permissions' => 1015,
                'route_url' => 'requested',
                'optional_params' => '/{type?}'
            ],

            [
                'status' => Self::APPROVED_STATUS,
                'text' => translate('Approved'),
                'route_name' => 'admin.shipments.approved.index',
                'permissions' => 1016,
                'route_url' => 'approved'
            ],

            [
                'status' => Self::CLOSED_STATUS,
                'text' => translate('Closed'),
                'route_name' => 'admin.shipments.closed.index',
                'permissions' => 1017,
                'route_url' => 'closed'
            ],

            [
                'status' => Self::CAPTAIN_ASSIGNED_STATUS,
                'text' => translate('Assigned'),
                'route_name' => 'admin.shipments.assigned.index',
                'permissions' => 1018,
                'route_url' => 'assigned'
            ],

            [
                'status' => Self::RECIVED_STATUS,
                'text' => translate('Received'),
                'route_name' => 'admin.shipments.captain.given.index',
                'permissions' => 1019,
                'route_url' => 'deliverd-to-driver'
            ],
            [
                'status' => Self::DELIVERED_STATUS,
                'text' => translate('Deliverd'),
                'route_name' => 'admin.shipments.delivred.index',
                'permissions' => 1020,
                'route_url' => 'delivred'
            ],
            [
                'status' => Self::SUPPLIED_STATUS,
                'text' => translate('Supplied'),
                'route_name' => 'admin.shipments.supplied.index',
                'permissions' => 1041,
                'route_url' => 'supplied'
            ],

            [
                'status' => Self::RETURNED_STATUS,
                'text' => translate('Returned'),
                'route_name' => 'admin.shipments.returned.sender.index',
                'permissions' => 1024,
                'route_url' => 'returned-on-sender'
            ],

            [
                'status' => Self::RETURNED_STOCK,
                'text' => translate('Returned Stock'),
                'route_name' => 'admin.shipments.returned.stock.index',
                'permissions' => 1025,
                'route_url' => 'returned-stock'
            ],

            [
                'status' => Self::RETURNED_CLIENT_GIVEN,
                'text' => translate('Returned & Deliverd'),
                'route_name' => 'admin.shipments.returned.deliverd.index',
                'permissions' => 1026,
                'route_url' => 'returned-deliverd'
            ],



        ];
        return $array;
    }
    public function getStatus()
    {
        $result = null;
        foreach (Self::status_info() as $status) {
            $status_id = $this->status_id;
            $result = (isset($status['status']) && $status['status'] == $status_id) ? $status['text'] : null;
            if ($result != null) {
                return $result;
            }
        }

        return $result;
    }
    static public function getStatusByStatusId($status_id_attr)
    {
        $result = null;
        foreach (Self::status_info() as $status) {
            $status_id = $status_id_attr;
            $result = (isset($status['status']) && $status['status'] == $status_id) ? $status['text'] : null;
            if ($result != null) {
                return $result;
            }
        }

        return $result;
    }

    static public function getStatusByRoute($route_name)
    {
        $result = null;
        foreach (Self::status_info() as $status) {
            $result = (isset($status['route_name']) && $status['route_name'] == $route_name) ? $status['status'] : null;
            return $result;
        }
        return $result;
    }

    public function getTypeAttribute($value)
    {
        if ($value == Self::DROPOFF) {
            return translate('Dropoff');
        } elseif ($value == Self::PICKUP) {
            return translate('Pickup');
        }
    }

    static public function getType($value)
    {
        if ($value == Self::DROPOFF) {
            return translate('Dropoff');
        } elseif ($value == Self::PICKUP) {
            return translate('Pickup');
        } else {
            return null;
        }
    }

    public function getPaymentMethodAttribute($value)
    {
        if ($value == Self::CASH_METHOD) {
            return translate('Cash');
        } elseif ($value == Self::PAYPAL_METHOD) {
            return translate('Paypal');
        }
    }
    public function getPaymentType()
    {
        if ($this->payment_type == Self::POSTPAID) {
            return translate('Postpaid');
        } elseif ($this->payment_type == Self::PREPAID) {
            return translate('Prepaid');
        }
    }

    static public function getShipmentsReport($branch_id,$client_id,$type,$status)
    {
        $shipments = Shipment::orderBy('id','desc');

        if (isset($status) && !empty($status)) {

            $shipments = $shipments->where('status_id', $status);
        }
        if (isset($client_id) && !empty($client_id)) {

            $shipments = $shipments->where('client_id', $client_id);
        }
        if (isset($branch_id) && !empty($branch_id)) {
            $shipments = $shipments->where('branch_id', $branch_id);
        }
        if (isset($type) && !empty($type)) {
            $shipments = $shipments->where('type', $type);
        }
        $shipments = $shipments->get();
        $data = array();

        foreach ($shipments as $record) {
            $order['branch'] = $record->branch->name;
            $order['client_id'] = $record->client->name;

            $order['type'] = $record->type;
            $order['status'] = $record->getStatus();

            $data[] = $order;
            $order = array();
        }
        return $data;
    }
    public function client()
    {
        return $this->hasOne('App\Client', 'id', 'client_id');
    }

    public function captain()
    {
        return $this->hasOne('App\Captain', 'id', 'captain_id');
    }

    public function current_mission()
    {
        return $this->hasOne('App\Mission', 'id', 'mission_id');
    }

    public function branch()
    {
        return $this->hasOne('App\Branch', 'id', 'branch_id');
    }

    public function logs()
    {
        return $this->hasMany('App\ClientShipmentLog', 'shipment_id', 'id');
    }

    public function from_country(){
		return $this->hasOne('App\Country', 'id' , 'from_country_id');
	}
    public function to_country(){
		return $this->hasOne('App\Country', 'id' , 'to_country_id');
	}
    public function from_state(){
		return $this->hasOne('App\State', 'id' , 'from_state_id');
	}
    public function to_state(){
		return $this->hasOne('App\State', 'id' , 'to_state_id');
	}
    public function from_area(){
		return $this->hasOne('App\Area', 'id' , 'from_area_id');
	}
    public function to_area(){
		return $this->hasOne('App\Area', 'id' , 'to_area_id');
	}

    public function pay()
    {
        return $this->belongsTo('App\BusinessSetting', 'payment_method_id');
    }

    public function payment()
    {
        return $this->hasOne('App\Payment', 'shipment_id' , 'id');
    }

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
