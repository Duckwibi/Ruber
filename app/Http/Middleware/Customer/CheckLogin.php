<?php

namespace App\Http\Middleware\Customer;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        return $next($request);
    }
}
