<?php

namespace App\Http\Middleware\Customer;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin{
    public function handle(Request $request, Closure $next): mixed{

        if(!Auth::check()){

            if(request()->ajax()){
                return response()->json([
                    "message" => "Please log in to your account!",
                    "success" => "/Customer/Authenticate/LoginPage"
                ])->withHeaders(["Content-type" => "application/json"]);
            }
            return redirect("/Customer/Authenticate/LoginPage");
        }

        $customer = Auth::user();
        if(!request()->session()->has("loginKey")){
            
            if(!Cookie::has("loginKey")){

                if(request()->ajax()){
                    return response()->json([
                        "message" => "Your session has expired please login again!",
                        "success" => "/Customer/Authenticate/LoginPage"
                    ])->withHeaders(["Content-type" => "application/json"]);
                }
                return redirect("/Customer/Authenticate/LoginPage");
            }

            if(Cookie::get("loginKey") != $customer->loginKey){

                if(request()->ajax()){
                    return response()->json([
                        "message" => "Your session has expired please login again!",
                        "success" => "/Customer/Authenticate/LoginPage"
                    ])->withHeaders(["Content-type" => "application/json"]);
                }
                return redirect("/Customer/Authenticate/LoginPage");
            }

            request()->session()->put([
                "loginKey" => $customer->loginKey
            ]);

            return $next($request);
        }

        if(request()->session()->get("loginKey") != $customer->loginKey){
            
            if(request()->ajax()){
                return response()->json([
                    "message" => "Your session has expired please login again!",
                    "success" => "/Customer/Authenticate/LoginPage"
                ])->withHeaders(["Content-type" => "application/json"]);
            }
            return redirect("/Customer/Authenticate/LoginPage");
        }

        return $next($request);
    }
}
