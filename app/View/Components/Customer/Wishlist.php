<?php

namespace App\View\Components\Customer;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\Component;

class Wishlist extends Component{
    public $wishlistCount;
    public function __construct(){
    }
    public function render(): mixed{

        if(!Auth::check()){
            $this->wishlistCount = 0;
            return view("components.customer.wishlist");
        }
        $customer = Auth::user();
        
        if(!request()->session()->has("loginKey")){

            if(!Cookie::has("loginKey")){
                $this->wishlistCount = 0;
                return view("components.customer.wishlist");
            }

            if(Cookie::get("loginKey") != $customer->loginKey){
                $this->wishlistCount = 0;
                return view("components.customer.wishlist");
            }

            $customer->loadCount("wishlistProducts");
            $this->wishlistCount = $customer->wishlist_products_count;

            request()->session()->put([
                "loginKey" => $customer->loginKey
            ]);

            return view("components.customer.wishlist");
        }

        if(request()->session()->get("loginKey") != $customer->loginKey){
            $this->wishlistCount = 0;
            return view("components.customer.wishlist");
        }

        $customer->loadCount("wishlistProducts");
        $this->wishlistCount = $customer->wishlist_products_count;

        return view("components.customer.wishlist");
    }
}
