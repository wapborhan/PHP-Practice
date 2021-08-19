<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminWidget extends Model
{
    public function container_widget(){
        return $this->hasMany(AdminContainerWidget::class, 'widget_id')->orderBy('sort', 'asc');
    }
}
