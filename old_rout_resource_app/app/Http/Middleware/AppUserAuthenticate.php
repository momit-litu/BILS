<?php

namespace App\Http\Middleware;
use App\Traits\HasPermission;
use Closure;

class AppUserAuthenticate
{
    public function handle($request, Closure $next)
    {
        if(!auth()->guard('appUser')->check()) {
            //return redirect(route('app/login'));
			return redirect('app/login');
        }
		//dd($request);
        return $next($request);
    }
}
