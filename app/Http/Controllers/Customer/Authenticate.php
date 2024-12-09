<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Mail\Customer\VerifyEmail;
use App\Models\Customer;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\MyFunction\Utilities;

class Authenticate extends Controller{
    public function registerPage(): mixed{
        return view("Customer.Register")->with(["title" => "Register Page"]);
    }

    public function register(): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "name" => ["bail", "required", "string", "max:255"],
                "email" => ["bail", "required", "string", "max:255"],
                "firstName" => ["bail", "required", "string", "max:255"],
                "lastName" => ["bail", "required", "string", "max:255"],
                "password" => ["bail", "required", "string", "max:10"],
                "passwordConfirm" => [
                    "bail", 
                    "required", 
                    "string", 
                    "max:10",
                    function(string $attribute, string $value, Closure $closure): void{
                        if($value != request()->password){
                            $closure("Authentication password does not match password!");
                        }
                    }
                ],
            ]
        );

        $name = request()->name;
        $email = request()->email;
        $firstName = request()->firstName;
        $lastName = request()->lastName;
        $password = request()->password;

        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        if(Customer::where("name", $name)->orWhere("email", $email)->count() != 0){
            return response()->json([
                "message" => "Account name and email already exist!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }
            
        $otp = "";
        for($i = 1; $i <= 6; $i++)
            $otp .= rand(0, 9);

        Mail::to($email)->send(new VerifyEmail($otp));

        request()->session()->put([
            "registerData" => [
                "name" => $name,
                "email" => $email,
                "firstName" => $firstName,
                "lastName" => $lastName,
                "password" => $password,
                "otp" => $otp,
                "expired" => date("Y-m-d H:i:s", strtotime("+1 minutes"))
            ]
        ]);

        return response()->json([
            "message" => "We have sent a verification code to your email, the code will expire in 1 minutes!",
            "success" => "/Customer/Authenticate/VerifyEmailPage"
        ])->withHeaders(["Content-type" => "application/json"]);
    }

    public function verifyEmailPage(): mixed{

        if(!request()->session()->has("registerData")){
            return redirect("/404");
        }
        
        $registerData = (object)request()->session()->get("registerData");

        if(Utilities::dateCompare(date("Y-m-d H:i:s"), $registerData->expired) == 1){
            request()->session()->forget("registerData");
            return redirect("/404");
        }

        return view("Customer.VerifyEmail")->with(["title" => "Verify Email Page"]);
    }

    public function verifyEmail(): mixed{

        if(!request()->session()->has("registerData")){
            return response()->json([
                "error" => "/404"
            ])->withHeaders(["Content-type" => "application/json"]);
        }
        
        $registerData = (object)request()->session()->get("registerData");

        if(Utilities::dateCompare(date("Y-m-d H:i:s"), $registerData->expired) == 1){
            request()->session()->forget("registerData");

            return response()->json([
                "message" => "The verification code has expired!",
                "success" => "/Customer/Authenticate/RegisterPage"
            ])->withHeaders(["Content-type" => "application/json"]);
        }
            
        $validator = Validator::make(
            request()->all(),
            [
                "otp" => [
                    "bail", 
                    "required", 
                    "string",
                    "max:6",
                    function(string $attribute, string $value, Closure $closure) use($registerData): void{
                        if($value != $registerData->otp){
                            $closure("The verification code entered does not match!");
                        }
                    }
                ]
            ]
        );

        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        if(
            Customer::where("name", $registerData->name)
            ->orWhere("email", $registerData->email)->count() != 0
        ){

            return response()->json([
                "message" => "Account name and email already exist!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }
        
        $customer = new Customer();
        $customer->name = $registerData->name;
        $customer->email = $registerData->email;
        $customer->firstName = $registerData->firstName;
        $customer->lastName = $registerData->lastName;
        $customer->password = Hash::make($registerData->password);
        $customer->save();

        request()->session()->forget("registerData");

        return response()->json([
            "message" => "Verify successful!",
            "success" => "/Customer/Authenticate/LoginPage"
        ])->withHeaders(["Content-type" => "application/json"]);
    }

    public function loginPage(): mixed{

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return view("Customer.Login")->with(["title" => "Login Page"]);
    }

    public function login(): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "nameOrEmail" => ["bail", "required", "string", "max:255"],
                "password" => ["bail", "required", "string", "max:10"],
                "rememberMe" => ["bail", "sometimes", "required", "boolean"],
            ]
        );

        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $nameOrEmail = request()->nameOrEmail;
        $password = request()->password;
        $rememberMe = request()->has("rememberMe") ? (bool)request()->rememberMe : false;

        if(
            !Auth::attempt([
                "name" => $nameOrEmail,
                "password" => $password
            ], $rememberMe)

            && !Auth::attempt([
                "email" => $nameOrEmail,
                "password" => $password
            ], $rememberMe)
        ){
            return response()->json([
                "message" => "Name, email or password does not exist!",
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        if(request()->session()->has("registerData")){
            request()->session()->forget("registerData");
        }

        return response()->json([
            "message" => "Login successful!",
            "success" => "/Customer/Home"
        ])->withHeaders(["Content-type" => "application/json"]);
    }
}
