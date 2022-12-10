<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthCheck extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$guards)
    {
        if (Auth::guard('users')->check()) {
            return $next($request);
        } else {
            return redirect()->route('home');
        }
    }
}
