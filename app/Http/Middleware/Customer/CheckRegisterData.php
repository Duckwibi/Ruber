<?php

namespace App\Http\Middleware\Customer;

use App\MyFunction\Utilities;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRegisterData{
    public function handle(Request $request, Closure $next): mixed{

        if(!request()->session()->has("registerData")){

            if(request()->ajax()){
                return response()->json([
                    "error" => "/Customer/Error/NotFoundPage"
                ])->withHeaders(["Content-type" => "application/json"]);
            }

            return redirect("/Customer/Error/NotFoundPage");
        }
        
        $registerData = (object)request()->session()->get("registerData");

        if(Utilities::dateCompare(date("Y-m-d H:i:s"), $registerData->expired) == 1){
            request()->session()->forget("registerData");

            if(request()->ajax()){
                return response()->json([
                    "message" => "The verification code has expired!",
                    "success" => "/Customer/Authenticate/RegisterPage"
                ])->withHeaders(["Content-type" => "application/json"]);
            }

            return redirect("/Customer/Error/NotFoundPage");
        }

        return $next($request);
    }
}
