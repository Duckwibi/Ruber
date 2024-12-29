<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductReview extends Model{
    use HasFactory;
    protected $table = "product_review";
    public $timestamps = false;
    public function product(): BelongsTo{
        return $this->belongsTo(Product::class, "productId", "id");
    }
    public function customer(): BelongsTo{
        return $this->belongsTo(Customer::class, "customerId", "id");
    }
}
