<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model{
    use HasFactory;
    protected $table = "blog";
    public $timestamps = false;

    public function tags(): BelongsToMany{
        return $this->belongsToMany(
            Tag::class,
            "blog_tag",
            "blogId",
            "tagId",
        )->using(BlogTag::class);
    }

    public function admin(): BelongsTo{
        return $this->belongsTo(Admin::class, "adminId", "id");
    }

    public function blogCategory(): BelongsTo{
        return $this->belongsTo(BlogCategory::class, "blogCategoryId", "id");
    }

    public function blogComments(): HasMany{
        return $this->hasMany(BlogComment::class, "blogId", "id");
    }
}
