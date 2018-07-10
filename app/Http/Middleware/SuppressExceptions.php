<?php

namespace App\Http\Middleware;

use Closure;

class SuppressExceptions
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
    error_reporting(0);
    return $next($request);
}
}
