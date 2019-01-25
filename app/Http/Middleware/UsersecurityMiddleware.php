<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UsersecurityMiddleware
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

           if($request->id==Auth::guard('member')->user()->member_id){

                 return $next($request);    
           }else{

                return redirect()->route('unauthorized');
           }
       
    }
}
