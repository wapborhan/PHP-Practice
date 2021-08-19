<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QCod\AppSettings\Setting\AppSettings;
use App\AdminTheme;
use Harimayco\Menu\Models\Menus;

class AdminThemeController extends Controller
{
    public function index()
    {
        $themes = AdminTheme::all();
        return view('backend.website_settings.theme.index', ['themes'=>$themes]);
    }

    public function update_active(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }
        $request->validate([
            'id' => 'required|exists:admin_themes,id', // container_widget belongs to this widget 
        ]);
        $active_themes = AdminTheme::where('active','=',1)->get();
        foreach ($active_themes as $active_theme) {
            $active_theme->active = 0;
            $active_theme->save();
        }
        $theme = AdminTheme::find($request->id);
        $theme->active = 1;
        $theme->save();
        flash(translate('This theme is activated successfully'))->success();
        return redirect()->back();
    }

    public function options(AppSettings $appSettings)
    {
        $menus = Menus::all();
        $active_theme = AdminTheme::where('active','=',1)->get()->first();
        $jsonString = file_get_contents(base_path('themes/'.$active_theme->name.'/theme_options.json'));
        $sections = json_decode($jsonString, true);
        $sections = $this->set_lang($sections);
        config(['app_settings.sections' => $sections]);
        $settings = $appSettings->loadConfig(config('app_settings', []));
        // return $settings;
        return view('backend.website_settings.theme_option.index', 
                    ['settings'=>$settings,
                    'active_theme' => $active_theme->name,
                    'menus' => $menus,
                    ]);
    }

    private function set_lang($sections)
    {
        foreach ($sections as $section_key => $section) {
            foreach ($section['inputs'] as $input_key => $input) {
                $sections[$section_key]['inputs'][$input_key]['name'] = $input['name'] . "_" . app()->getLocale(); 
            }
        }
        return $sections;
    }
}
