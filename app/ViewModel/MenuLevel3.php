<?php

namespace App\ViewModel;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MenuLevel3 extends Model{
    use HasFactory;
    protected $table = "menu_level3";

    public function menuLv2(): BelongsTo{
        return $this->belongsTo(MenuLevel2::class, "parentId", "id");
    }

    public function blogCategory(): HasOne{
        return $this->hasOne(BlogCategory::class, "menuId", "id");
    }
}