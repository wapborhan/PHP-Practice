<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;
use App\Page;
use App\Language;
use App\Category;

class MenuController extends Controller
{
    public function index()
    {
        $pages = Page::select('title','slug')->get();
        if(class_exists("App\Category")){
            $categories = Category::select('title','slug')->get();
            $data = [
                'pages'=>$pages,
                'categories'=>$categories,
            ];
        }else{
            $data = [
                'pages'=>$pages,
            ];
        }
        return view('backend.website_settings.menu.index', $data);
    }

    public function widget_update($widget,$request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $request->validate([
            'menu' => 'nullable|exists:admin_menus,id',
            'title' => 'nullable|max:255',
        ]);
        $menu = Menus::find($request->menu);
        $value = json_decode($widget->value);
        $value->id = $request->menu;
        
        $widget->value = json_encode($value);
        $widget->title = $request->title;
        $widget->save();

        return $widget;
    }

    public function widget_view_frontend($widget)
    {
        $widget_frontend = json_decode($widget->widget_frontend);
        $value = json_decode($widget->value);
        $menu = Menus::find($value->id);
        $widget_value = json_decode($widget->value);
        return view($widget_frontend->view, [
            'widget' => $widget,
            'menu' => $menu,
            'widget_value' => $widget_value,
        ]);
    }

    public function widget_view_backend($widget ,$view_type)
    {
        $menus = Menus::all();
        $widget_value = json_decode($widget->value);
        $langs = Language::all();
        if ($view_type  == "widget" ) {
            $widget_backend = json_decode($widget->widget_backend);
            return view($widget_backend->view, [
                'widget' => $widget,
                'menus' => $menus,
                'widget_value' => $widget_value,
                'langs' => $langs,
            ]);
        } elseif( $view_type  == "container_widget" ) {
            $value = json_decode($widget->value);
            $menu_id = $value->id;
            $container_widget_backend = json_decode($widget->container_widget_backend);
            return view($container_widget_backend->view, [
                'container_widget' => $widget,
                'menus' => $menus,
                'menu_id' => $menu_id,
                'widget_value' => $widget_value,
                'langs' => $langs,
            ]);
        }
    }
}
