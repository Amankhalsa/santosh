<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Auth;

class CheckSuperAdmin
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
        if( Auth::check() ){
          if( Auth::user()->admin_type == "SuperAdmin" ){
            return $next($request);
          }else{
              abort(404);
          }
        }
    }
}
