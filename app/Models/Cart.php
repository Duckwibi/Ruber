<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Cart extends Pivot{
    use HasFactory;
    protected $table = "cart";
    public $timestamps = false;
    public function customer(): BelongsTo{
        return $this->belongsTo(Customer::class, "customerId", "id");
    }
    public function product(): BelongsTo{
        return $this->belongsTo(Product::class, "productId", "id");
    }
}
