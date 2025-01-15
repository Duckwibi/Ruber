<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Mail\Customer\VerifyEmail;
use App\Models\Customer;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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
            
        $otp = Utilities::getOtp();
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
        return view("Customer.VerifyEmail")->with(["title" => "Verify Email Page"]);
    }

    public function verifyEmail(): mixed{
        
        $registerData = (object)request()->session()->get("registerData");
            
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

        $customer = Auth::user();
        request()->session()->put([
            "loginKey" => $customer->loginKey
        ]);

        if($rememberMe){
            Cookie::queue("loginKey", $customer->loginKey, 60 * 24 * 365);
        }

        return response()->json([
            "message" => "Login successful!",
            "success" => "/Customer/Home/IndexPage"
        ])->withHeaders(["Content-type" => "application/json"]);
    }

    public function resetPasswordPage(): mixed{
        return view("Customer.ResetPassword")->with(["title" => "Reset Password"]);
    }

    public function resetPassword(): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "newPassword" => ["bail", "required", "string", "max:10"]
            ]
        );
        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        if(Auth::check()){
            $customer = Auth::user();
            if(!request()->session()->has("loginKey")){
                if(Cookie::has("loginKey")){
                    if(Cookie::get("loginKey") == $customer->loginKey){
                        
                        $otp = Utilities::getOtp();
                        Mail::to($customer)->send(new VerifyEmail($otp));
            
                        request()->session()->put([
                            "otpForResetPasswordData" => [
                                "newPassword" => request()->newPassword,
                                "customerId" => $customer->id,
                                "otp" => $otp,
                                "expired" => date("Y-m-d H:i:s", strtotime("+1 minutes"))
                            ]
                        ]);

                        request()->session()->put([
                            "loginKey" => $customer->loginKey
                        ]);
            
                        return response()->json([
                            "message" => "We have sent a verification code to your email, the code will expire in 1 minutes!",
                            "success" => "/Customer/Authenticate/VerifyEmailPageForResetPassword"
                        ])->withHeaders(["Content-type" => "application/json"]);
                    }
                }
            }else{
                if(request()->session()->get("loginKey") == $customer->loginKey){
                    $otp = Utilities::getOtp();
                    Mail::to($customer)->send(new VerifyEmail($otp));
        
                    request()->session()->put([
                        "otpForResetPasswordData" => [
                            "newPassword" => request()->newPassword,
                            "customerId" => $customer->id,
                            "otp" => $otp,
                            "expired" => date("Y-m-d H:i:s", strtotime("+1 minutes"))
                        ]
                    ]);
        
                    return response()->json([
                        "message" => "We have sent a verification code to your email, the code will expire in 1 minutes!",
                        "success" => "/Customer/Authenticate/VerifyEmailPageForResetPassword"
                    ])->withHeaders(["Content-type" => "application/json"]);
                }
            }
        }

        request()->session()->put([
            "resetPasswordData" => [
                "newPassword" => request()->newPassword
            ]
        ]);

        return response()->json([
            "message" => "Please go to the email entry page to receive the verification code!",
            "success" => "/Customer/Authenticate/EnterEmailPageForResetPassword"
        ])->withHeaders(["Content-type" => "application/json"]);
    }

    public function enterEmailPageForResetPassword(): mixed{
        return view("Customer.EnterEmailForResetPassword")->with(["title" => "Reset Password"]);
    }

    public function enterEmailForResetPassword(): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "email" => ["bail", "required", "string", "max:255"]
            ]
        );

        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $customer = Customer::where("email", request()->email)->first();
        if(!isset($customer)){
            return response()->json([
                "message" => "Email does not exist!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $otp = Utilities::getOtp();
        Mail::to($customer)->send(new VerifyEmail($otp));

        $resetPasswordData = (object)request()->session()->get("resetPasswordData");
        request()->session()->put([
            "otpForResetPasswordData" => [
                "newPassword" => $resetPasswordData->newPassword,
                "customerId" => $customer->id,
                "otp" => $otp,
                "expired" => date("Y-m-d H:i:s", strtotime("+1 minutes"))
            ]
        ]);
        request()->session()->forget("resetPasswordData");

        return response()->json([
            "message" => "We have sent a verification code to your email, the code will expire in 1 minutes!",
            "success" => "/Customer/Authenticate/VerifyEmailPageForResetPassword"
        ])->withHeaders(["Content-type" => "application/json"]);
    }

    public function verifyEmailPageForResetPassword(): mixed{
        return view("Customer.VerifyEmailForResetPassword")->with(["title" => "Reset Password"]);
    }

    public function verifyEmailForResetPassword(): mixed{

        $otpForResetPasswordData = (object)request()->session()->get("otpForResetPasswordData");

        $validator = Validator::make(
            request()->all(),
            [
                "otp" => [
                    "bail", 
                    "required", 
                    "string", 
                    "max:6",
                    function(string $attribute, string $value, Closure $closure) use($otpForResetPasswordData): void{
                        if($value != $otpForResetPasswordData->otp){
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

        $customer = Customer::find($otpForResetPasswordData->customerId);
        if(!isset($customer)){
            return response()->json([
                "message" => "Customer does not exist!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $customer->password = Hash::make($otpForResetPasswordData->newPassword);
        $customer->loginKey = Utilities::getRandomKey(64);
        $customer->save();
        
        request()->session()->forget("otpForResetPasswordData");

        return response()->json([
            "message" => "Verify successful!",
            "success" => "/Customer/Home/IndexPage"
        ])->withHeaders(["Content-type" => "application/json"]);
    }
}
