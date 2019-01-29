<?php

namespace App\Http\Middleware;

use Closure;
use App\Member;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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


         $member = Member::all()->count();

        return $next($request);


            if (!($member== 1)) {
            if (!Auth::guard('member')->user()->hasPermissionTo('Administer roles & permissions')) //If user does //not have this permission
        {
                abort('401');
            }
        }

        return $next($request);
    }
}
