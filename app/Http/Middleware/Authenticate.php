<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Route;
class Authenticate extends Middleware
{

      protected $guards = [];
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    protected function redirectTo($request)
    {
      $guard=$request->guard;
      if($request->guard)
        if (!$request->expectsJson()) {
          if(Route::is('admin.*')){
            return route('admin.login');
          }if(Route::is('staff.*')){
            return route('login');
          }if(Route::is('student.*')){
            return route('login');
          }
        }
    }
}
