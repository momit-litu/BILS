<?php

namespace App\Http\Middleware;

//use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure
class AppUserAuthenticate extends Middleware
{
    public function handle($request, Closure $next, $guard="appUser")
    {
        if(!auth()->guard($guard)->check()) {
            return redirect(route('appUser.login'));
        }
        return $next($request);
    }
}
