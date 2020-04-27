<?php

namespace App\Http\Middleware;

use Closure;

class EnsureEmailIsVerify
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

        if($request->user() && !$request->user()->hasVerifiedEmail() &&!$request->is('email/*','logout')){
            return $request->expectsJson()?abort(403,'your email address is not verify'):redirect()->route('verification.notice');
        }
        return $next($request);
    }
}
