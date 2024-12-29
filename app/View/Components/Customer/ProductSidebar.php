<?php

namespace App\View\Components\Customer;

use App\Models\Brand;
use App\Models\PriceFilter;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Size;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\View\Component;

class ProductSidebar extends Component{
    public $productCategories;
    public $priceFilters;
    public $brands;
    public $products;
    public function __construct(
        public $id,
        public $priceFilterId,
        public $brandId,
        public $sort
    ){}
    public function render(): mixed{

        $this->productCategories = ProductCategory::withCount("products")->get();
        $this->priceFilters = PriceFilter::orderBy("order")->get();
        
        $id = $this->id;
        $this->brands = Brand::whereHas("products", function(Builder $query) use($id): void{
            $query->where("product.productCategoryId", $id);
        })->get();

        $this->products = Product::where("productCategoryId", $id)
        ->orderBy("priceAfterSale")
        ->limit(3)
        ->selectRaw("product.*, (price - price * (sale / 100)) as priceAfterSale")
        ->withAvg("productReviews", "product_review.rate")
        ->get();

        return view("components.customer.product-sidebar");
    }
}
