<?php

namespace App\Http\Middleware\Customer;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteRegisterData{
    public function handle(Request $request, Closure $next): mixed{
        
        if(request()->session()->has("registerData")){
            request()->session()->forget("registerData");
        }

        return $next($request);
    }
}
