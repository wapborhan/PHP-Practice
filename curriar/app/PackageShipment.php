<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageShipment extends Model
{
    protected $guarded = [];
    protected $table = 'package_shipment';
    
    
    public function package(){
		return $this->hasOne('App\Package', 'id' , 'package_id');
	}
}
