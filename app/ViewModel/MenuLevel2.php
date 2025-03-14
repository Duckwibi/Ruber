<?php

namespace App\ViewModel;

use App\Models\Menu;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MenuLevel2 extends Model{
    use HasFactory;
    protected $table = "menu_level2";

    public function menu(): BelongsTo{
        return $this->belongsTo(Menu::class, "parentId", "id");
    }
    public function menuLevel3s(): HasMany{
        return $this->hasMany(MenuLevel3::class, "parentId", "id");
    }

    public function productCategory(): HasOne{
        return $this->hasOne(ProductCategory::class, "menuId", "id");
    }
}
