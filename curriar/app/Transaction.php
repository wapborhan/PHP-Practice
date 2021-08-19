<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    CONST MESSION_TYPE = 1;
    CONST SHIPMENT_TYPE = 2;
    CONST MANUAL_TYPE = 3;

    CONST CAPTAIN = 1;
    CONST CLIENT = 2;
    CONST BRANCH = 3;

    CONST DEBIT = 1;   // -
    CONST CREDIT = 2;  // +

    public function client()
    {
        return $this->belongsTo('App\Client', 'client_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch', 'branch_id');
    }

    public function captain()
    {
        return $this->belongsTo('App\Captain', 'captain_id');
    }

    public function mission()
    {
        return $this->belongsTo('App\Mission', 'mission_id');
    }

    public function shipment()
    {
        return $this->belongsTo('App\Shipment', 'shipment_id');
    }
}
