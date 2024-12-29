<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Favorite extends Controller{
    
    public function wishlistPage(): mixed{

        $wishlists = Wishlist::where("customerId", Auth::id())
        ->orderByDesc("createdDate")
        ->with([
            "product" => function(Builder $query): void{
                $query->selectRaw("product.*, (price - price * (sale / 100)) as priceAfterSale");
            }
        ])
        ->get();

        return view("Customer.Wishlist")->with([
            "title" => "Wishlist Page",
            "wishlists" => $wishlists
        ]);
    }

    public function addProductToWishlist(): mixed{

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
        if($customer->wishlistProducts()->where("wishlist.productId", $productId)->count() != 0){
            return response()->json([
                "message" => "Product already exists in your wishlist!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $customer->wishlistProducts()->attach($productId, [
            "createdDate" => date("Y-m-d H:i:s")
        ]);

        return response()->json([
            "message" => "Added successfully!"
        ])->withHeaders(["Content-type" => "application/json"]);
    }

    public function deleteProductFromWishlist(): mixed{

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
        if($customer->wishlistProducts()->where("wishlist.productId", $productId)->count() == 0){
            return response()->json([
                "message" => "Product does not exist in your wishlist!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $customer->wishlistProducts()->detach($productId);
        $wishlistCount = $customer->wishlistProducts()->count();

        return response()->json([
            "message" => "Deleted successfully!",
            "wishlistCount" => $wishlistCount
        ])->withHeaders(["Content-type" => "application/json"]);
    }
}
