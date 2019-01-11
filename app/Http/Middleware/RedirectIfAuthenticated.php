<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
        case 'member':
          if (Auth::guard($guard)->check()) {
                 
             $user=Auth::guard('member')->user();

                          if($user->hasRole('Admin')){
        return redirect()->intended('roles');
    }elseif($user->hasRole('Chair')){
        return redirect()->intended('/');
    }elseif($user->hasRole('Accountant')){
        return redirect()->intended('/');
    }elseif($user->hasRole('Loan Officer')){
           return redirect()->intended('/');
         }elseif($user->hasRole('Cashier')){
             
            return redirect()->intended('/'); 
         }else{
             $id=Auth::guard('member')->user()->member_id;
             return redirect()->intended('/member/'.$id.'/profile');
         }

          }
          break;
        default:
          if (Auth::guard($guard)->check()) {
              return redirect('/home');
          }
          break;
      }

        return $next($request);
    }
}
