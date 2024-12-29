<?php

namespace App\Http\Middleware\Customer;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteResetPasswordData{
    public function handle(Request $request, Closure $next): mixed{

        if(request()->session()->has("resetPasswordData")){
            request()->session()->forget("resetPasswordData");
        }

        return $next($request);
    }
}
