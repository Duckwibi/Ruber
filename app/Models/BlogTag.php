<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogTag extends Pivot{
    use HasFactory;
    protected $table = "blog_tag";
    public $timestamps = false;

    public function blog(): BelongsTo{
        return $this->belongsTo(Blog::class, "blogId", "id");
    }

    public function tag(): BelongsTo{
        return $this->belongsTo(Tag::class, "tagId", "id");
    }
}
