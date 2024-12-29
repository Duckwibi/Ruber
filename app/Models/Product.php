<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model{
    use HasFactory;
    protected $table = "product";
    public $timestamps = false;
    public function productCategory(): BelongsTo{
        return $this->belongsTo(ProductCategory::class, "productCategoryId", "id");
    }
    public function brand(): BelongsTo{
        return $this->belongsTo(Brand::class, "brandId", "id");
    }
    public function productDetailImages(): HasMany{
        return $this->hasMany(ProductDetailImage::class, "productId", "id");
    }
    public function productReviews(): HasMany{
        return $this->hasMany(ProductReview::class, "productId", "id");
    }
    public function wishlistCustomers(): BelongsToMany{
        return $this->belongsToMany(
            Customer::class, 
            "wishlist", 
            "productId", 
            "customerId"
        )->using(Wishlist::class);
    }
    public function cartCustomers(){
        return $this->belongsToMany(
            Customer::class, 
            "wishlist", 
            "productId", 
            "customerId"
        )->using(Cart::class);
    }
    public function orders(){
        return $this->belongsToMany(
            Order::class,
            "order_detail",
            "productId",
            "orderId"
        )->using(OrderDetail::class);
    }
}
