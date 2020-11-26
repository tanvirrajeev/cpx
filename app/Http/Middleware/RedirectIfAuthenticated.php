<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && Auth::user()->role->name == 'Admin'){
            return redirect()->route('admin.dashboard');
        }elseif(Auth::guard($guard)->check() && Auth::user()->role->name == 'Customer'){
            return redirect()->route('customer.cpx');
        }elseif(Auth::guard($guard)->check() && Auth::user()->role->name == 'Branch Staff'){
            return redirect()->route('branch.dashboard');
        }elseif(Auth::guard($guard)->check() && Auth::user()->role->name == 'Dhaka Finance Staff'){
            return redirect()->route('branch.dashboard');
        }else{
            return $next($request);
        }
    }
}
