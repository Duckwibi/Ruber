<?php

namespace App\Http\Middleware\Customer;

use App\MyFunction\Utilities;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOtpForResetPasswordData{
    public function handle(Request $request, Closure $next): mixed{

        if(!request()->session()->has("otpForResetPasswordData")){
            
            if(request()->ajax()){
                return response()->json([
                    "error" => "/Customer/Error/NotFoundPage"
                ])->withHeaders(["Content-type" => "application/json"]);
            }
            return redirect("/Customer/Error/NotFoundPage");
        }

        $otpForResetPasswordData = (object)request()->session()->get("otpForResetPasswordData");

        if(Utilities::dateCompare(date("Y-m-d H:i:s"), $otpForResetPasswordData->expired) == 1){
            request()->session()->forget("otpForResetPasswordData");
            
            if(request()->ajax()){
                return response()->json([
                    "message" => "The verification code has expired!",
                    "success" => "/Customer/home"
                ])->withHeaders(["Content-type" => "application/json"]);
            }
            return redirect("/Customer/Error/NotFoundPage");
        }

        return $next($request);
    }
}
