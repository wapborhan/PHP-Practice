<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminContainer;
use App\AdminContainerWidget;
use App\AdminWidget;
use App\AdminTheme;

class AdminContainerController extends Controller
{
    public function index()
    {
        $active_theme = AdminTheme::where('active','=',1)->get()->first();
        $this->control_footer($active_theme);
        $containers = AdminContainer::where('theme_name','=',$active_theme->name)->get();
        $widgets = AdminWidget::all();
        return view('backend.website_settings.widget.index',['containers'=>$containers,'widgets'=>$widgets]);
    }

    private function control_footer($active_theme)
    {
        $theme_footer_containers_number = setting()->get($active_theme->name.'_footer_item_number_'.app()->getLocale()) ?? 0;
        $curr_footer_containers_number = AdminContainer::where('theme_name',$active_theme->name)->where('type','footer')->count();
        if($curr_footer_containers_number != $theme_footer_containers_number){
            if($curr_footer_containers_number > $theme_footer_containers_number){
                $delete_count = $curr_footer_containers_number - $theme_footer_containers_number;
                $footer_containers = AdminContainer::where('theme_name',$active_theme->name)->where('type','footer')->orderBy('id', 'desc')->take($delete_count)->get();
                $footer_containers->each->delete();
            }else{
                for ($i=$curr_footer_containers_number; $i < $theme_footer_containers_number; $i++) { 
                    $container = new AdminContainer();
                    $container->title = "Footer " . ($i+1);
                    $container->name = "footer_".($i+1);
                    $container->theme_name = $active_theme->name;
                    $container->type = "footer";
                    $container->save();
                }
            }
            
        }
        return true;
    }

    public function store($request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $container = new AdminContainer();
        $container->title = $request['title'];
        $container->name = $request['name'];
        $container->theme_name = $request['theme_name'];
        $container->active = $request['active'] ?? 1;
        $container->save();

        return $container;
    }

    public function update($request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $container = AdminContainer::find($request['id']);
        if($container){
            $container->title = $request['title'] ?? $container->title;
            $container->name = $request['name'] ?? $container->name;
            $container->theme_name = $request['theme_name'] ?? $container->theme_name;
            $container->active = $request['active'] ?? $container->active;
            $container->save();

            return $container;
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
        $container = AdminContainer::find($id);
        if($container){
            if(count($container->container_widget) == 0){
                $container->delete();
                return translate('Container has been deleted successfully');
            }else{
                return translate("You can't delete this container , you have to delete or move all widgets first");
            }
        }else{
            return translate('Invalid ID');
        }
    }

    public function get_by_name($name,$theme_name)
    {
        $container = AdminContainer::where('name',$name)->where('theme_name',$theme_name)->get();
        return $container;
    }
}
