<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class FrontendWidget extends AbstractWidget
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
            $widget_frontend = json_decode($this->config['container_widget']->widget_frontend);
            return app($widget_frontend->controller)->{$widget_frontend->function}($this->config['container_widget']);
        }
    }
}