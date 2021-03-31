<?php

namespace App\Http\Middleware;
use Carbon\Carbon;
use App\Constants\Constant;
use Closure;

class CheckWasher
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
        return $next($request);
    }
}
