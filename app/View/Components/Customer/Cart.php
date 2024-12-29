<?php

namespace App\View\Components\Customer;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\Component;

class Cart extends Component{
    public $cartCount;
    public function __construct(){
    }
    public function render(): mixed{

        if(!Auth::check()){
            $this->cartCount = 0;
            return view("components.customer.cart");
        }
        $customer = Auth::user();

        if(!request()->session()->has("loginKey")){

            if(!Cookie::has("loginKey")){
                $this->cartCount = 0;
                return view("components.customer.cart");
            }
            
            if(Cookie::get("loginKey") != $customer->loginKey){
                $this->cartCount = 0;
                return view("components.customer.cart");
            }
            
            $customer->loadCount("cartProducts");
            $this->cartCount = $customer->cart_products_count;
            
            request()->session()->put([
                "loginKey" => $customer->loginKey
            ]);

            return view("components.customer.cart");
        }

        if(request()->session()->get("loginKey") != $customer->loginKey){
            $this->cartCount = 0;
            return view("components.customer.cart");
        }
        
        $customer->loadCount("cartProducts");
        $this->cartCount = $customer->cart_products_count;

        return view("components.customer.cart");
    }
}
