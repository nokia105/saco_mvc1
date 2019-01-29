<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use \Spatie\Permission\Models\Role;

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

          if($user->hasAnyRole(Role::all())){

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
