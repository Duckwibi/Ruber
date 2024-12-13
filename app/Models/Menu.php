<?php

namespace App\Models;

use App\ViewModel\MenuLevel2;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Menu extends Model{
    use HasFactory;

    protected $table = "menu";
    public $timestamps = false;

    public function blogCategory(): HasOne{
        return $this->hasOne(BlogCategory::class, "menuId", "id");
    }

    public function menuLevel2s(){
        return $this->hasMany(MenuLevel2::class, "parentId", "id");
    }
}
