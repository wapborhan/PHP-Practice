<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminContainer;
use App\AdminContainerWidget;
use App\AdminWidget;

class AdminWidgetController extends Controller
{
    public function store($request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $widget = new AdminWidget();
        $widget->title = $request['title'] ?? '';
        $widget->name = $request['name'] ?? '';
        $widget->value = $request['value'] ?? '';
        $widget->link = $request['link'] ?? '';
        $widget->class = $request['class'] ?? '';
        $widget->type = $request['type'] ?? '';
        $widget->object = $request['object'] ?? '';
        $widget->save();

        // flash(translate('New widget has been created successfully'))->success();
        return $widget;
    }

    public function update($request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $widget = AdminWidget::find($request['id']);
        if($widget){
            $widget->title = $request['title'] ?? $widget->title;
            $widget->name = $request['name'] ?? $widget->name;
            $widget->value = $request['value'] ?? $widget->value;
            $widget->link = $request['link'] ?? $widget->link;
            $widget->class = $request['class'] ?? $widget->class;
            $widget->type = $request['type'] ?? $widget->type;
            $widget->object = $request['object'] ?? $widget->object;
            $widget->save();
            return $widget;
        }else{
            return translate('Invalid ID');
        }
    }

    public function destroy($id)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $widget = AdminWidget::find($id);
        if($widget){
            $widget->delete();
            return translate('Widget has been deleted successfully');
        }else{
            return translate('Invalid ID');
        }
    }

    public function clone(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $request->validate([
            'container_widgets' => 'required|array',
            // 'container_widgets.*' => 'required|exists:admin_container_widgets,id',
            'widget_id' => 'required|exists:admin_widgets,id', // container_widget belongs to this widget 
            'container_id' => 'required|exists:admin_containers,id',
            'source' => 'nullable|exists:admin_containers,id',
        ]);
        // return $request;
        $new_container_widget_id = 0;

        foreach ($request->container_widgets as $key => $container_widget_id) {
            $container_widget = AdminContainerWidget::find($container_widget_id);
            if($container_widget){
                // return $container_widget;
                $container_widget->container_id = $request->container_id;
                $container_widget->sort = $key;
                $container_widget->save();
            }else{
                $widget = AdminWidget::find($request->widget_id); // container_widget belongs to this widget 
                $container_widget = new AdminContainerWidget();
                $container_widget->title = $widget->title;
                $container_widget->name = $widget->name;
                $container_widget->value = $widget->value;
                $container_widget->link = $widget->link;
                $container_widget->sort = $key;
                $container_widget->class = $widget->class;
                $container_widget->type = $widget->type;
                $container_widget->object = $widget->object;
                $container_widget->widget_id = $widget->id;
                $container_widget->container_id = $request->container_id;
                $container_widget->count = $widget->count;
                $container_widget->widget_frontend = $widget->widget_frontend;
                $container_widget->widget_backend = $widget->widget_backend;
                $container_widget->container_widget_backend = $widget->container_widget_backend;
                $container_widget->update = $widget->update;
                // return $container_widget;
                $container_widget->save();
                $new_container_widget_id = $container_widget->id; 
            }
        }
        return ['id'=>$new_container_widget_id,'title'=>$container_widget->title,'message'=>"Widget has been Added successfully!"];
        
    }

}
