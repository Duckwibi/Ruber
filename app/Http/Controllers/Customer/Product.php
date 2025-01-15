<?php

namespace App\Http\Controllers\Customer;

use App\Events\Customer\UpdateProductReview;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\OrderDetail;
use App\Models\PriceFilter;
use App\Models\ProductCategory;
use App\Models\ProductReview;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class Product extends Controller{
    public function productCategoryPage(): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "id" => ["bail", "required", "integer"],
                "priceFilterId" => ["bail", "sometimes", "required", "integer"],
                "brandId" => ["bail", "sometimes", "required", "integer"],
                "sort" => ["bail", "sometimes", "required", "integer", "min:1", "max:5"],
                "currentPage" => ["bail", "sometimes", "required", "integer", "min:1"]
            ]
        );
        if($validator->stopOnFirstFailure()->fails()){
            return redirect("/Customer/Error/NotFoundPage");
        }

        $id = (int)request()->id;
        $productCategory = ProductCategory::find($id);
        if(!isset($productCategory)){
            return redirect("/Customer/Error/NotFoundPage");
        }

        $priceFilterId = request()->has("priceFilterId") ? (int)request()->priceFilterId : null;
        $priceFilter = null;
        if(isset($priceFilterId)){
            $priceFilter = PriceFilter::find($priceFilterId);
            if(!isset($priceFilter)){
                return redirect("/Customer/Error/NotFoundPage");
            }
        }

        $brandId = request()->has("brandId") ? (int)request()->brandId : null;
        $brand = null;
        if(isset($brandId)){
            $brand = Brand::find($brandId);
            if(!isset($brand)){
                return redirect("/Customer/Error/NotFoundPage");
            }
        }

        $sort = request()->has("sort") ? (int)request()->sort : null;

        $productsCount = \App\Models\Product::where("productCategoryId", $id)
        ->when(isset($priceFilterId), function(Builder $query) use($priceFilter): void{
            $query->whereRaw("price - price * (sale / 100) between ? and ?", [$priceFilter->min, $priceFilter->max]);
        })
        ->when(isset($brandId), function(Builder $query) use($brand): void{
            $query->where("brandId", $brand->id);
        })
        ->count();

        $page = $productsCount / 9.0;
        $page = $page - (int)$page == 0 ? $page : (int)$page + 1;
        $page = $page == 0 ? 1 : $page;
        $currentPage = request()->has("currentPage") ? (int)request()->currentPage : 1;
        $currentPage = $currentPage > $page ? $page : $currentPage;

        
        $products = \App\Models\Product::leftJoinSub(
            OrderDetail::groupBy("productId")
            ->selectRaw("
                order_detail.productId,
                sum(order_detail.quantity) as quantityTotal
            "),
            "order_detail_with_quantity_total",
            function(JoinClause $query): void{
                $query->on("order_detail_with_quantity_total.productId", "product.id");
            }
        )
        ->where("productCategoryId", $id)
        ->when(isset($priceFilterId), function(Builder $query) use($priceFilter): void{
            $query->whereRaw("price - price * (sale / 100) between ? and ?", [$priceFilter->min, $priceFilter->max]);
        })
        ->when(isset($brandId), function(Builder $query) use($brand): void{
            $query->where("brandId", $brand->id);
        })
        ->when(isset($sort), function(Builder $query) use($sort): void{
            switch($sort){
                case 1: 
                    $query->orderByDesc("orderQuantityTotal");
                    break;
                case 2:
                    $query->orderByDesc("product_reviews_avg_product_reviewrate");
                    break;
                case 3:
                    $query->orderByDesc("createdDate"); 
                    break;
                case 4:
                    $query->orderBy("priceAfterSale");
                    break;
                case 5:
                    $query->orderByDesc("priceAfterSale");
            }
        })
        ->limit(9)->offset(($currentPage - 1) * 9)
        ->selectRaw("
            product.*, 
            (product.price - product.price * (product.sale / 100)) as priceAfterSale,
            case when order_detail_with_quantity_total.quantityTotal is null then 0
                else order_detail_with_quantity_total.quantityTotal end as orderQuantityTotal
        ")
        ->withCount("productReviews")
        ->withAvg("productReviews", "product_review.rate")
        ->get();


        return view("Customer.ProductCategory")->with([
            "title" => "Product Category Page",
            "productCategory" => $productCategory,
            "productsCount" => $productsCount,
            "products" => $products,
            "priceFilterId" => $priceFilterId,
            "brandId" => $brandId,
            "sort" => $sort,
            "page" => $page,
            "currentPage" => $currentPage
        ]);
    }

    public function productDetailPage(): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "id" => ["bail", "required", "integer"]
            ]
        );
        if($validator->stopOnFirstFailure()->fails()){
            return redirect("/Customer/Error/NotFoundPage");
        }

        $id = (int)request()->id;
        $product = \App\Models\Product::where("id", $id)
        ->selectRaw("product.*, (price - price * (sale / 100)) as priceAfterSale")
        ->with([
            "productDetailImages" => function(Builder $query): void{
                $query->orderBy("order");
            }
        ])
        ->withCount("productReviews")
        ->withAvg("productReviews", "product_review.rate")
        ->with("brand")
        ->with("productCategory")
        ->with([
            "productReviews" => [
                "customer"
            ]
        ])
        ->first();

        if(!isset($product)){
            return redirect("/Customer/Error/NotFoundPage");
        }

        $relatedProducts = \App\Models\Product::where("productCategoryId", $product->productCategoryId)
        ->where("id", "<>", $product->id)
        ->orderByDesc("createdDate")
        ->limit(9)
        ->selectRaw("product.*, (price - price * (sale / 100)) as priceAfterSale")
        ->withAvg("productReviews", "product_review.rate")
        ->get();

        $currentUser = Auth::check() ? Auth::user() : null;
        if(isset($currentUser)){
            if(request()->session()->has("loginKey")){
                $currentUser = request()->session()->get("loginKey") == $currentUser->loginKey ? $currentUser : null;
            }else{
                $currentUser = Cookie::has("loginKey") ? $currentUser : null;
                if(isset($currentUser)){
                    $currentUser = Cookie::get("loginKey") == $currentUser->loginKey ? $currentUser : null;
                    if(isset($currentUser)){
                        request()->session()->put([
                            "loginKey" => $currentUser->loginKey
                        ]);
                    }
                }
            }
        }

        return view("Customer.ProductDetail")->with([
            "title" => "Product Detail Page",
            "product" => $product,
            "relatedProducts" => $relatedProducts,
            "currentUser" => $currentUser
        ]);
    }

    public function review(): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "content" => ["bail", "required", "string", "max:1000"],
                "rate" => ["bail", "required", "integer", "min:0", "max:5"],
                "productId" => ["bail", "required", "integer"]
            ]
        );
        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $product = \App\Models\Product::where("id", request()->productId)->first();
        if(!isset($product)){
            return response()->json([
                "message" => "Product does not exist!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $productReview = new ProductReview();
        $productReview->content = request()->content;
        $productReview->rate = (int)request()->rate;
        $productReview->createdDate = date("Y-m-d H:i:s");
        $productReview->productId = $product->id;
        $customer = Auth::user();
        $customer->productReviews()->save($productReview);

        $product->loadAvg("productReviews", "product_review.rate");
        $avgRate = (int)$product->product_reviews_avg_product_reviewrate;

        UpdateProductReview::dispatch($productReview, $customer, $avgRate);

        return response()->json([
            "message" => "Posted successfully!"
        ])->withHeaders(["Content-type" => "application/json"]);
    }
}
