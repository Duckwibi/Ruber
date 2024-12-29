<?php

namespace App\Http\Middleware\Customer;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PhoneVerify{
    public function handle(Request $request, Closure $next): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "phone" => [
                    "bail", 
                    "required", 
                    "string", 
                    "max:10",
                    // function(string $attribute, string $value, Closure $closure): void{
                    //     if(
                    //         !Http::get("https://phonevalidation.abstractapi.com/v1/", [
                    //             "api_key" => env("ABSTRACTAPI_API_KEY"),
                    //             "phone" => $value,
                    //             "country" => "VN"
                    //         ])->object()->valid
                    //     ){
                    //         $closure("Phone does not exist!");
                    //     }
                    // }
                ]
            ]
        );
        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        return $next($request);
    }
}
