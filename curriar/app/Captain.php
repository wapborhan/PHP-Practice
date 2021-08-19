<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Captain extends Model
{
  const PICKUP_MISSION = 1;
  const DELIVERY_MISSION = 2;
  const ALL_MISSIONS = 3;
  protected $guarded = [];
  public function userCaptain()
  {
    return $this->hasOne('App\UserCaptain', 'captain_id', 'id');
  }
  public function branch()
  {
    return $this->hasOne('App\Branch', 'id', 'branch_id');
  }
  public function transaction(){
    return $this->hasMany(Transaction::class, 'captain_id');
  }
  public function getTypeAttribute($value)
  {
    if ($value == Self::PICKUP_MISSION) {
      return translate('Pickup');
    } elseif ($value == Self::DELIVERY_MISSION) {
      return translate('Delivery');
    } elseif ($value == Self::ALL_MISSIONS) {
      return translate('Pickup & Delivery');
    } else {
      return $value;
    }
  }
}
