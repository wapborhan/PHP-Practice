<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminContainerWidget extends Model
{
    public function widget(){
        return $this->belongsTo(AdminWidget::class, 'widget_id');
    }
    
    public function container(){
        return $this->belongsTo(AdminContainer::class, 'container_id');
    }
    
    public function parent(){
        return $this->belongsTo(AdminWidgetItem::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(AdminWidgetItem::class, 'parent_id');
    }
}
