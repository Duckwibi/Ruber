<?php

namespace App\Http\Middleware\Customer;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class CheckExistOrder{
    public function handle(Request $request, Closure $next): mixed{
        
        if(Auth::check()){
            $cutomer = Auth::user();

            if(!request()->session()->has("loginKey")){
                if(Cookie::has("loginKey")){
                    if(Cookie::get("loginKey") == $cutomer->loginKey){

                        request()->session()->put([
                            "loginKey" => $cutomer->loginKey
                        ]);

                        if(
                            Order::where("customerId", $cutomer->id)
                            ->where("isApproved", false)->count() != 0
                        ){
                            if(request()->ajax()){
                                return response()->json([
                                    "error" => "/Customer/Checkout/CheckoutPage"
                                ])->withHeaders(["Content-type" => "application/json"]);
                            }
    
                            return redirect("/Customer/Checkout/CheckoutPage");
                        }
                    }
                }
            }else{
                if(request()->session()->get("loginKey") == $cutomer->loginKey){

                    if(
                        Order::where("customerId", $cutomer->id)
                        ->where("isApproved", false)->count() != 0
                    ){
                        if(request()->ajax()){
                            return response()->json([
                                "error" => "/Customer/Checkout/CheckoutPage"
                            ])->withHeaders(["Content-type" => "application/json"]);
                        }
    
                        return redirect("/Customer/Checkout/CheckoutPage");
                    }
                }
            }
        }

        return $next($request);
    }
}
