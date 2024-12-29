<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model{
    use HasFactory;
    protected $table = "product_category";
    public $timestamps = false;
    public function menu(): BelongsTo{
        return $this->belongsTo(Menu::class, "menuId", "id");
    }
    public function products(): HasMany{
        return $this->hasMany(Product::class, "productCategoryId", "id");
    }
}
