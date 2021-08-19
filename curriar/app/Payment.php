<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function shipment()
    {
        return $this->belongsTo('App\Shipment', 'shipment_id');
    }
    public function client()
    {
        return $this->belongsTo('App\Client', 'seller_id');
    }
}
