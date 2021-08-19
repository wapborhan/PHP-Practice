<?php

namespace App\Http\Middleware;  
  
use Closure;  
use Illuminate\Contracts\Auth\Guard;  
use Response;  
use App\User;
  
class checkHeader  
{  
    /** 
     * The Guard implementation. 
     * 
     * @var Guard 
     */  
  
    /** 
     * Handle an incoming request. 
     * 
     * @param  \Illuminate\Http\Request  $request 
     * @param  \Closure  $next 
     * @return mixed 
     */  
    public function handle($request, Closure $next)  
    {    
        if(!isset($_SERVER['HTTP_AUTH_TOKEN'])){  
            return Response::json(array('error'=>'Please set custom header'));  
        }  

        $user = User::where('api_token', $_SERVER['HTTP_AUTH_TOKEN'])->first();
        
        if(!$user){  
            return Response::json(array('error'=>'invalid or Expired Api Key'));  
        }  
        
        return $next($request);  
    }  
}