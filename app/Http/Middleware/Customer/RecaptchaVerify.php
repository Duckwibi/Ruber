<?php

namespace App\Http\Middleware\Customer;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class RecaptchaVerify{
    public function handle(Request $request, Closure $next): mixed{
        $validator = Validator::make(
            $request->all(),
            [
                "g_recaptcha_response" => [
                    "bail",
                    "required",
                    function(string $attribute, mixed $value, Closure $closure): void{
                        $response = Http::get("https://www.google.com/recaptcha/api/siteverify", [
                            "secret" => env("RECAPTCHA_V2_SECRET"),
                            "response" => $value
                        ]);

                        if($response->object()->success == null){
                            $closure("Please confirm you are not a robot by completing the reCAPTCHA!");
                        }
                }]
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
