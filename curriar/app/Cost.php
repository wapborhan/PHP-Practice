<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $guarded = [];
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
}
