<?php

namespace App\Http\Middleware\Customer;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckResetPasswordData{
    public function handle(Request $request, Closure $next): mixed{

        if(!request()->session()->has("resetPasswordData")){

            if(request()->ajax()){
                return response()->json([
                    "error" => "/Customer/Error/NotFoundPage"
                ])->withHeaders(["Content-type" => "application/json"]);
            }
            return redirect("/Customer/Error/NotFoundPage");
        }

        return $next($request);
    }
}
