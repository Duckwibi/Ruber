<?php

namespace App\Http\Middleware\Customer;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteOtpForResetPasswordData{
    public function handle(Request $request, Closure $next): mixed{

        if(request()->session()->has("otpForResetPasswordData")){
            request()->session()->forget("otpForResetPasswordData");
        }

        return $next($request);
    }
}
