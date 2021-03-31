<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Response;

class CheckUser
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
        $user = Auth::user();
        if($user->status == 0){
            $response = [
                'status' => 201,
                'message' => trans('message.ACCOUNT_MESSAGE_DEACITVE'),
                'data' => [],
            ];
            return response()->json($response, 201);
           
        }
        return $next($request);
    }
}
