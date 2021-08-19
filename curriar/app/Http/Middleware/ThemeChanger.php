<?php

namespace App\Http\Middleware;

use Closure;
use Qirolab\Theme\Theme;
use App\AdminTheme;

class ThemeChanger
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
        $current_theme = Theme::active();
        $active_theme = AdminTheme::where('active','=',1)->get()->first();
        if($active_theme && $active_theme->name != $current_theme){
            Theme::set($active_theme->name);
        }else{
            Theme::set('main');
        }
        return $next($request);
    }
}
