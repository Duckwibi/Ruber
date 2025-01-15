<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Mail\Customer\VerifyEmail;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\SliderBanner;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;

class Home extends Controller{
    
    public function indexPage(): mixed{

        $products = Product::leftJoinSub(
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
        ->orderByDesc("orderQuantityTotal")
        ->selectRaw("
            product.*,
            (product.price - product.price * (product.sale / 100)) as priceAfterSale,
            case when order_detail_with_quantity_total.quantityTotal is null then 0
                else order_detail_with_quantity_total.quantityTotal end as orderQuantityTotal
        ")
        ->limit(9)
        ->get();

        $sliderBanners = SliderBanner::orderBy("order")->get();

        return view("Customer.Index")->with([
            "title" => "Index Page",
            "sliderBanners" => $sliderBanners,
            "products" => $products
        ]);
    }
}
