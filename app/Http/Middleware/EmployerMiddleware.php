<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmployerMiddleware
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

        if(Auth::user()->user_type == "admin_user" || Auth::user()->user_type == "super_admin") // is an admin
        {
            return $next($request); // pass the admin
        }

        return redirect('/'); // not admin. redirect whereever you like
    }
}
