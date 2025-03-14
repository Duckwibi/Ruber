<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductDetailImage extends Model{
    use HasFactory;
    protected $table = "product_detail_image";
    public $timestamps = false;
    public function product(): BelongsTo{
        return $this->belongsTo(Product::class, "productId", "id");
    }
}
