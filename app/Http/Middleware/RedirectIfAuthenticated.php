<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if(auth()->user()->hasRole('lead')) {
                  return redirect('/lead/dashboard');
                } elseif(auth()->user()->hasRole('techcore')) {
                  return redirect('/techcore/dashboard');
                } elseif (auth()->user()->hasRole('nontechcore')) {
                  return redirect('/nontechcore/dashboard');
                } else {
                  return redirect('/member/dashboard');
                }
            }
        }

        return $next($request);
    }
}
