<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Authenticatable{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "customer";
    public $timestamps = false;
    public function blogComments(): HasMany{
        return $this->hasMany(BlogComment::class, "customerId", "id");
    }
    public function productReviews(): HasMany{
        return $this->hasMany(ProductReview::class, "customerId", "id");
    }
    public function wishlistProducts(): BelongsToMany{
        return $this->belongsToMany(
            Product::class,
            "wishlist",
            "customerId",
            "productId"
        )->using(Wishlist::class);
    }
    public function cartProducts(): BelongsToMany{
        return $this->belongsToMany(
            Product::class,
            "cart",
            "customerId",
            "productId"
        )->using(Cart::class);
    }
    public function orders(): HasMany{
        return $this->hasMany(Order::class, "customerId", "id");
    }
    
    protected $hidden = [
        "email",
        "password"
    ];
}
