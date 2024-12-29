<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model{
    use HasFactory;
    protected $table = "order";
    public $timestamps = false;
    public function customer(): BelongsTo{
        return $this->belongsTo(Customer::class, "customerId", "id");
    }
    public function products(): BelongsToMany{
        return $this->belongsToMany(
            Product::class,
            "order_detail",
            "orderId",
            "productId"
        )->using(OrderDetail::class);
    }
}
