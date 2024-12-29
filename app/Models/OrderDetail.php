<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderDetail extends Pivot{
    use HasFactory;
    protected $table = "order_detail";
    public $timestamps = false;
    public function order(): BelongsTo{
        return $this->belongsTo(Order::class, "orderId", "id");
    }
    public function product(): BelongsTo{
        return $this->belongsTo(Product::class, "productId", "id");
    }
}
