<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wishlist extends Pivot{
    use HasFactory;
    protected $table = "wishlist";
    public $timestamps = false;
    public function customer(): BelongsTo{
        return $this->belongsTo(Customer::class, "customerId", "id");
    }
    public function product(): BelongsTo{
        return $this->belongsTo(Product::class, "productId", "id");
    }
}
