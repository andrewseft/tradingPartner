<?php

namespace App\Http\Middleware;
use App\Helpers\Helper;
use Closure;
use App\Constants\Constant;


class CheckPermission
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
        $id = auth()->guard(Constant::GUARD)->user()->id;
        $roleId = auth()->guard(Constant::GUARD)->user()->role_id;
        $user = auth()->guard(Constant::GUARD)->user();
        $action = Helper::userPermission('action',$user);
        $currentAction = Helper::currentAction();
        if($roleId == Constant::SUB_ADMIN){
            if(!in_array($currentAction,$action)){
				return redirect(route('admin.permission'));
			}
        }
        return $next($request);
    }
}
