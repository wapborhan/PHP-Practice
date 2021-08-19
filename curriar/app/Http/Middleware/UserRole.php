<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        $roles = explode('|', $roles);
        if (Auth::check() && (  in_array(Auth::user()->user_type, $roles) )) {
            return $next($request);
        }
        else{
            abort(404);
        }
    }
}
