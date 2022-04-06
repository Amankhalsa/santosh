<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Auth;
class CheckRole18
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
       if( Auth::check()) {
        if(Auth::user()->admin_type == "Admin" || Auth::user()->admin_type == "SubAdmin" ){
         if( in_array("18", explode(",",Auth::user()->admin_roles)) ){
            return $next($request);
         }else{
            abort(404);
         }
        }else{
            return $next($request);
        }
    }


    }
}
