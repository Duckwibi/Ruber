<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogCategory extends Model{
    use HasFactory;
    protected $table = "blog_category";
    public $timestamps = false;

    public function blogs(): HasMany{
        return $this->hasMany(Blog::class, "blogCategoryId", "id");
    }

    public function menu(): BelongsTo{
        return $this->belongsTo(Menu::class, "menuId", "id");
    }
}
