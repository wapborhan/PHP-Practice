<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminContainer;
use App\AdminContainerWidget;
use App\AdminWidget;
use App\AdminTheme;
use App\Language;

class AdminContainerWidgetController extends Controller
{
    public function update(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        // return $request;
        $request->validate([
            'id' => 'required|exists:admin_container_widgets,id',
        ]);
        $widget = AdminContainerWidget::find($request->id);
        $update = json_decode($widget->update);
        $widget = app($update->controller)->{$update->function}($widget,$request);
        $widget->lang = $request->lang ?? 'all';
        $widget->save();

        if ($request->ajax()) {
            return $widget;
        }else{
            flash(translate('Widget has been updated successfully'))->success();
            return redirect()->route('website.container.index');
        }
        
    }

    public function destroy($id)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $container_widget = AdminContainerWidget::findOrFail($id);
        if($container_widget->object){
            $object = json_decode($container_widget->object);
            if(isset( $object->value->logo )){
                if (\Storage::exists($object->value->logo)) {
                    \Storage::delete($object->value->logo);
                }
            }
        }
        if($container_widget->value){
            $value = json_decode($container_widget->value);
            if(isset( $value->logo )){
                if (\Storage::exists($value->logo)) {
                    \Storage::delete($value->logo);
                }
            }
        }
        $container_widget->delete();
        flash(translate('Widget has been deleted successfully'))->success();
        return redirect()->back();
    }

    public function sign_up_view_frontend($widget)
    {
        $widget_frontend = json_decode($widget->widget_frontend);
        $sign_up = json_decode($widget->value);
        return view($widget_frontend->view, [
            'widget' => $widget,
            'sign_up' => $sign_up,
        ]);
    }

    public function sign_up_view_backend($widget ,$view_type)
    {
        $sign_up = json_decode($widget->value);
        $langs = Language::all();
        if ($view_type  == "widget" ) {
            $widget_backend = json_decode($widget->widget_backend);
            return view($widget_backend->view, [
                'widget' => $widget,
                'sign_up' => $sign_up,
                'langs' => $langs,
            ]);
        } elseif( $view_type  == "container_widget" ) {
            $container_widget_backend = json_decode($widget->container_widget_backend);
            return view($container_widget_backend->view, [
                'container_widget' => $widget,
                'sign_up' => $sign_up,
                'langs' => $langs,
            ]);
        }
    }
    
    public function widget_update_sign_up($widget ,$request)
    {
        $request->validate([
            'title' => 'nullable|max:255',
            'subtitle' => 'nullable|max:255',
            'description' => 'nullable|max:255',
            'hits' => 'nullable|max:255',
        ]);
        $value = [
            "title" => $request->title,
            "subtitle" => $request->subtitle,
            "description" => $request->description,
            "hits" => $request->hits,
        ];
        $widget->value = json_encode($value);
        $widget->save();
        return $widget;
    }

    public function about_view_frontend($widget)
    {
        $widget_frontend = json_decode($widget->widget_frontend);
        $about = json_decode($widget->value);
        return view($widget_frontend->view, [
            'widget' => $widget,
            'about' => $about,
        ]);
    }

    public function about_view_backend($widget ,$view_type)
    {
        $about = json_decode($widget->value);
        $langs = Language::all();
        if ($view_type  == "widget" ) {
            $widget_backend = json_decode($widget->widget_backend);
            return view($widget_backend->view, [
                'widget' => $widget,
                'about' => $about,
                'langs' => $langs,
            ]);
        } elseif( $view_type  == "container_widget" ) {
            $container_widget_backend = json_decode($widget->container_widget_backend);
            return view($container_widget_backend->view, [
                'container_widget' => $widget,
                'about' => $about,
                'langs' => $langs,
            ]);
        }
    }
    
    public function widget_update_about($widget ,$request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $request->validate([
            'email' => 'nullable|max:255',
            'phone' => 'nullable|max:50',
            'logo' => 'nullable|mimes:jpeg,png,svg|max:5120',
            'description' => 'nullable|max:600',
        ]);
        $about = json_decode($widget->value);
        if($request->hasFile('logo')){
            $extension = $request->logo->extension();
            $img_name = time();
            $request->logo->storeAs('/widget', $img_name.".".$extension);
            $logo = 'widget/'.$img_name.".".$extension;
        }
        if($request->hasFile('logo') || $request->remove_logo){
            if (\Storage::exists($about->logo)) {
                \Storage::delete($about->logo);
            }
            $about->logo   = $logo ?? null;
        }
        $about->description = $request->description;
        $about->email = $request->email;
        $about->phone = $request->phone;

        $widget->title = 'ABOUT';
        $widget->value = json_encode($about);
        $widget->save();
        return $widget;
    }

    public function business_view_frontend($widget)
    {
        $widget_frontend = json_decode($widget->widget_frontend);
        $business = json_decode($widget->value);
        return view($widget_frontend->view, [
            'widget' => $widget,
            'business' => $business,
        ]);
    }

    public function business_view_backend($widget ,$view_type)
    {
        $business = json_decode($widget->value);
        $langs = Language::all();
        if ($view_type  == "widget" ) {
            $widget_backend = json_decode($widget->widget_backend);
            return view($widget_backend->view, [
                'widget' => $widget,
                'business' => $business,
                'langs' => $langs,
            ]);
        } elseif( $view_type  == "container_widget" ) {
            $container_widget_backend = json_decode($widget->container_widget_backend);
            return view($container_widget_backend->view, [
                'container_widget' => $widget,
                'business' => $business,
                'langs' => $langs,
            ]);
        }
    }
    
    public function widget_update_business($widget ,$request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $request->validate([
            'email' => 'nullable|max:255',
            'phone' => 'nullable|max:50',
            'logo' => 'nullable|mimes:jpeg,png,svg|max:5120',
            'description' => 'nullable|max:255',
        ]);
        $business = json_decode($widget->value);
        $business->title = $request->title;
        $business->description = $request->description;
        $business->label_1 = $request->label_1;
        $business->value_1 = $request->value_1;
        $business->label_2 = $request->label_2;
        $business->value_2 = $request->value_2;
        $business->label_3 = $request->label_3;
        $business->value_3 = $request->value_3;
        $business->label_4 = $request->label_4;
        $business->value_4 = $request->value_4;
        $business->label_5 = $request->label_5;
        $business->value_5 = $request->value_5;

        $widget->value = json_encode($business);
        $widget->save();
        return $widget;
    }

    public function image_view_frontend($widget)
    {
        $widget_frontend = json_decode($widget->widget_frontend);
        $image = json_decode($widget->value);
        return view($widget_frontend->view, [
            'widget' => $widget,
            'image' => $image,
        ]);
    }

    public function image_view_backend($widget ,$view_type)
    {
        $image = json_decode($widget->value);
        $langs = Language::all();
        if ($view_type  == "widget" ) {
            $widget_backend = json_decode($widget->widget_backend);
            return view($widget_backend->view, [
                'widget' => $widget,
                'image' => $image,
                'langs' => $langs,
            ]);
        } elseif( $view_type  == "container_widget" ) {
            $container_widget_backend = json_decode($widget->container_widget_backend);
            return view($container_widget_backend->view, [
                'container_widget' => $widget,
                'image' => $image,
                'langs' => $langs,
            ]);
        }
    }
    
    public function widget_update_image($widget ,$request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $request->validate([
            'logo' => 'nullable|mimes:jpeg,png,svg|max:5120',
        ]);
        $image = json_decode($widget->value);
        if($request->hasFile('logo')){
            $extension = $request->logo->extension();
            $img_name = time();
            $request->logo->storeAs('/widget', $img_name.".".$extension);
            $logo = 'widget/'.$img_name.".".$extension;
        }
        if($request->hasFile('logo') || $request->remove_logo){
            if (\Storage::exists($image->logo)) {
                \Storage::delete($image->logo);
            }
            $image->logo   = $logo ?? null;
        }
        
        $widget->value = json_encode($image);
        $widget->save();
        return $widget;
    }

    public function contact_info_view_frontend($widget)
    {
        $widget_frontend = json_decode($widget->widget_frontend);
        $contact_info = json_decode($widget->value);
        return view($widget_frontend->view, [
            'widget' => $widget,
            'contact_info' => $contact_info,
        ]);
    }

    public function contact_info_view_backend($widget ,$view_type)
    {
        $contact_info = json_decode($widget->value);
        $langs = Language::all();
        if ($view_type  == "widget" ) {
            $widget_backend = json_decode($widget->widget_backend);
            return view($widget_backend->view, [
                'widget' => $widget,
                'contact_info' => $contact_info,
                'langs' => $langs,
            ]);
        } elseif( $view_type  == "container_widget" ) {
            $container_widget_backend = json_decode($widget->container_widget_backend);
            return view($container_widget_backend->view, [
                'container_widget' => $widget,
                'contact_info' => $contact_info,
                'langs' => $langs,
            ]);
        }
    }
    
    public function widget_update_contact_info($widget ,$request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $request->validate([
            'title' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'phone' => 'nullable|max:255',
            'email' => 'nullable|max:255',
        ]);
        $contact_info = json_decode($widget->value);
        $contact_info->address = $request->address;
        $contact_info->phone = $request->phone;
        $contact_info->email = $request->email;

        $widget->title = $request->title;
        $widget->value = json_encode($contact_info);
        $widget->save();
        return $widget;
    }

    public function text_view_frontend($widget)
    {
        $widget_frontend = json_decode($widget->widget_frontend);
        $text = json_decode($widget->value);
        return view($widget_frontend->view, [
            'widget' => $widget,
            'text' => $text,
        ]);
    }

    public function text_view_backend($widget ,$view_type)
    {
        $text = json_decode($widget->value);
        $langs = Language::all();
        if ($view_type  == "widget" ) {
            $widget_backend = json_decode($widget->widget_backend);
            return view($widget_backend->view, [
                'widget' => $widget,
                'text' => $text,
                'langs' => $langs,
            ]);
        } elseif( $view_type  == "container_widget" ) {
            $container_widget_backend = json_decode($widget->container_widget_backend);
            return view($container_widget_backend->view, [
                'container_widget' => $widget,
                'text' => $text,
                'langs' => $langs,
            ]);
        }
    }
    
    public function widget_update_text($widget ,$request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $request->validate([
            'title' => 'nullable|max:255',
            'description' => 'nullable|max:2255',
        ]);
        $text = json_decode($widget->value);
        $text->title = $request->title;
        $text->description = $request->description;

        $widget->value = json_encode($text);
        $widget->save();
        return $widget;
    }

    public function html_view_frontend($widget)
    {
        $widget_frontend = json_decode($widget->widget_frontend);
        $html = json_decode($widget->value);
        return view($widget_frontend->view, [
            'widget' => $widget,
            'html' => $html,
        ]);
    }

    public function html_view_backend($widget ,$view_type)
    {
        $html = json_decode($widget->value);
        $langs = Language::all();
        if ($view_type  == "widget" ) {
            $widget_backend = json_decode($widget->widget_backend);
            return view($widget_backend->view, [
                'widget' => $widget,
                'html' => $html,
                'langs' => $langs,
            ]);
        } elseif( $view_type  == "container_widget" ) {
            $container_widget_backend = json_decode($widget->container_widget_backend);
            return view($container_widget_backend->view, [
                'container_widget' => $widget,
                'html' => $html,
                'langs' => $langs,
            ]);
        }
    }
    
    public function widget_update_html($widget ,$request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $request->validate([
            // 'title' => 'nullable|max:255',
            'html' => 'nullable|max:22255',
        ]);
        $html = json_decode($widget->value);
        $html->html = $request->html;

        // $widget->title = $request->title;
        $widget->value = json_encode($html);
        $widget->save();
        return $widget;
    }

    public function social_view_backend($widget ,$view_type)
    {
        $social = json_decode($widget->value);
        $langs = Language::all();
        if ($view_type  == "widget" ) {
            $widget_backend = json_decode($widget->widget_backend);
            return view($widget_backend->view, [
                'widget' => $widget,
                'social' => $social,
                'langs' => $langs,
            ]);
        } elseif( $view_type  == "container_widget" ) {
            $container_widget_backend = json_decode($widget->container_widget_backend);
            return view($container_widget_backend->view, [
                'container_widget' => $widget,
                'social' => $social,
                'langs' => $langs,
            ]);
        }
    }

    public function social_view_frontend($widget)
    {
        $active_theme = AdminTheme::where('active','=',1)->get()->first();
        $social = json_decode($widget->value);
        $widget_frontend = json_decode($widget->widget_frontend);
        return view($widget_frontend->view, [
            'widget' => $widget,
            'social' => $social,
            'active_theme' => $active_theme,
        ]);
    }

    public function widget_update_social($widget ,$request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $request->validate([
            'front_title' => 'nullable|max:255',
        ]);
        $social = json_decode($widget->value);
        $social->front_title = $request->front_title;

        $widget->value = json_encode($social);
        $widget->save();
        return $widget;
    }
}
