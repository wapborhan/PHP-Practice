<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminContainer extends Model
{
    public function container_widget(){
        return $this->hasMany(AdminContainerWidget::class, 'container_id')->orderBy('sort', 'asc');
    }

    public function container_widget_with_lang(){
        return $this->hasMany(AdminContainerWidget::class, 'container_id')->whereIn('lang', [app()->getLocale(),"all"] )->orderBy('sort', 'asc');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($container) { // before delete() method call this
            $container->container_widget->each->delete();
        });
    }
}
