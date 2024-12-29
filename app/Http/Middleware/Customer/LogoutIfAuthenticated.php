<?php

namespace App\Http\Middleware\Customer;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class LogoutIfAuthenticated{
    public function handle(Request $request, Closure $next): mixed{

        Auth::logout();

        if(request()->session()->has("loginKey")){
            request()->session()->forget("loginKey");
        }
        
        if(Cookie::has("loginKey")){
            Cookie::expire("loginKey");
        }

        return $next($request);
    }
}
