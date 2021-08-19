<?php

namespace App\Http\Middleware;

use Closure;
use App\AdminTheme;

class ThemeOptionData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $active_theme = AdminTheme::where('active','=',1)->get()->first();
        $jsonString = file_get_contents(base_path('themes/'.$active_theme->name.'/theme_options.json'));
        $sections = json_decode($jsonString, true);
        $sections = $this->set_lang($sections);
        config(['app_settings.sections' => $sections]);
        return $next($request);
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
