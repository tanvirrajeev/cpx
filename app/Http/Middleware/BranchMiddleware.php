<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BranchMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(Auth::check() && Auth::user()->role->name == 'Branch Staff'){
            return $next($request);
        }elseif(Auth::check() && Auth::user()->role->name == 'Dhaka Finance Staff'){
            return $next($request);
        }else{
            return redirect()->route('login');
        }
    }
}
