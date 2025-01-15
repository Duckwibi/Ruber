<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CouponCode;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class Cart extends Controller{

    public function cartPage(): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "couponCodeName" => ["bail", "sometimes", "required", "string"]
            ]
        );
        if($validator->stopOnFirstFailure()->fails()){
            return redirect("/Customer/Error/NotFoundPage");
        }

        $couponCodeName = request()->has("couponCodeName") ? request()->couponCodeName : null;
        $couponCode = null;
        if(isset($couponCodeName)){
            $couponCode = CouponCode::where("name", $couponCodeName)
                        ->where("expiredDate", ">=", date("Y-m-d H:i:s"))->first();
            if(!isset($couponCode)){
                return redirect("/Customer/Error/NotFoundPage");
            }
        }

        $carts = \App\Models\Cart::join("product", function(JoinClause $query): void{
            $query->on("product.id", "productId");
        })
        ->where("customerId", Auth::id())
        ->orderByDesc("createdDate")
        ->selectRaw("
            cart.*,
            product.name as productName,
            product.image as productImage,
            (product.price - product.price * (product.sale / 100)) as productPriceAfterSale,
            ((product.price - product.price * (product.sale / 100)) * cart.quantity) as subTotal
        ")
        ->get();

        $subTotal = 0;
        foreach($carts as $cart){
            $subTotal += $cart->subTotal;
        }
        $sale = isset($couponCode) ? $subTotal * ($couponCode->sale / 100) : 0;
        $total = $subTotal - $sale;

        return view("Customer.Cart")->with([
            "title" => "Cart Page",
            "couponCodeName" => $couponCodeName,
            "carts" => $carts,
            "subTotal" => $subTotal,
            "sale" => $sale,
            "total" => $total
        ]);
    }

    public function updateCart(): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "couponCodeName" => ["bail", "sometimes", "required", "string"],
                "productIdWithQuantity" => ["bail", "required", "json"]
            ]
        );
        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $couponCodeName = request()->has("couponCodeName") ? request()->couponCodeName : null;
        if(isset($couponCodeName)){
            if(
                CouponCode::where("name", $couponCodeName)
                ->where("expiredDate", ">=", date("Y-m-d H:i:s"))->count() == 0
            ){
                return response()->json([
                    "message" => "Coupon code does not exist or expired!"
                ])->withHeaders(["Content-type" => "application/json"]);
            }
        }

        $productIdWithQuantity = json_decode(request()->productIdWithQuantity, true);
        $validator = Validator::make(
            [
                "productIdWithQuantity" => $productIdWithQuantity
            ],
            [
                "productIdWithQuantity" => ["bail", "required", "array"],
                "productIdWithQuantity.*" => ["bail", "required", "array:productId,quantity"],
                "productIdWithQuantity.*.productId" => ["bail", "required", "integer"],
                "productIdWithQuantity.*.quantity" => ["bail", "required", "integer", "min:1"]
            ]
        );
        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }
        
        $message = "";
        $customer = Auth::user();
        foreach($productIdWithQuantity as $item){
            $productId = (int)$item["productId"];
            $quantity = (int)$item["quantity"];

            $product = Product::find($productId);
            if(!isset($product)){
                $message .= "Product has id: " . $productId . " does not exist!\n";
                continue;
            }

            $cart = \App\Models\Cart::where("customerId", $customer->id)
                    ->where("productId", $productId)->first();
            if(!isset($cart)){
                $message .= "Product has id: " . $productId . " does not exist in your cart!\n";
                continue;
            }

            if($cart->quantity > $product->quantity){
                $customer->cartProducts()->detach($productId);
                continue;
            }

            if($quantity > $product->quantity){
                $message .= "Product has id: " . $productId . " has order quantity exceeding stock quantity!\n";
                continue;
            }

            $customer->cartProducts()->updateExistingPivot(
                $productId,
                [
                    "quantity" => $quantity
                ]
            );
        }

        return response()->json([
            "message" => $message != "" ? $message : "Updated successfully!",
            "success" => isset($couponCodeName) ?
                        "/Customer/Cart/CartPage?couponCodeName=" . urlencode($couponCodeName) :
                        "/Customer/Cart/CartPage"
        ])->withHeaders(["Content-type" => "application/json"]);
    }

    public function addProductToCart(): mixed{
        $validator = Validator::make(
            request()->all(),
            [
                "productId" => ["bail", "required", "integer"],
                "quantity" => ["bail", "sometimes", "required", "integer", "min:1"]
            ]
        );
        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $productId = (int)request()->productId;
        $product = Product::find($productId);
        if(!isset($product)){
            return response()->json([
                "message" => "Product does not exist!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $quantity = request()->has("quantity") ? (int)request()->quantity : 1;
        $customer = Auth::user();

        $cart = \App\Models\Cart::where("customerId", $customer->id)
                ->where("productId", $productId)->first();
        if(isset($cart)){
            if($quantity + $cart->quantity > $product->quantity){
                return response()->json([
                    "message" => "Order quantity exceeds product quantity!"
                ])->withHeaders(["Content-type" => "application/json"]);
            }

            $customer->cartProducts()->updateExistingPivot(
                $productId,
                [
                    "quantity" => $quantity + $cart->quantity
                ]
            );

            $cartCount = $customer->cartProducts()->count();
            return response()->json([
                "message" => "Added successfully!",
                "cartCount" => $cartCount
            ])->withHeaders(["Content-type" => "application/json"]);
        }
        
        if($quantity > $product->quantity){
            return response()->json([
                "message" => "Order quantity exceeds product quantity!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $customer->cartProducts()->attach(
            $productId,
            [
                "quantity" => $quantity,
                "createdDate" => date("Y-m-d H:i:s")
            ]
        );

        $cartCount = $customer->cartProducts()->count();
        return response()->json([
            "message" => "Added successfully!",
            "cartCount" => $cartCount
        ])->withHeaders(["Content-type" => "application/json"]);
    }

    public function deleteProductFromCart(): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "productId" => ["bail", "required", "integer"]
            ]
        );
        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $productId = (int)request()->productId;
        if(Product::where("id", $productId)->count() == 0){
            return response()->json([
                "message" => "Product does not exist!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $customer = Auth::user();
        if($customer->cartProducts()->where("cart.productId", $productId)->count() == 0){
            return response()->json([
                "message" => "Product does not exist in your cart!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $customer->cartProducts()->detach($productId);
        $cartCount = $customer->cartProducts()->count();

        return response()->json([
            "message" => "Deleted successfully!",
            "cartCount" => $cartCount
        ])->withHeaders(["Content-type" => "application/json"]);
    }
}
