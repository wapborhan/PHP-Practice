<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class BackendWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'container_widget'=> ''
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        if($this->config['container_widget']->type == 'query'){
            $widget_backend = json_decode($this->config['container_widget']->widget_backend);
            return app($widget_backend->controller)->{$widget_backend->function}($this->config['container_widget'],$this->config['type']);
        }

        if($this->config['type'] == "widget"){
            return view('widgets.backend.widget', [
                'config' => $this->config,
            ]);
        }elseif($this->config['type'] == "container_widget"){
            return view('widgets.backend.container_widget', [
                'config' => $this->config,
            ]);
        }
    }
}