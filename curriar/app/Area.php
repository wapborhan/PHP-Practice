<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $guarded = [];
    public function state(){
		return $this->hasOne('App\State', 'id' , 'state_id');
	}
    
    
}
