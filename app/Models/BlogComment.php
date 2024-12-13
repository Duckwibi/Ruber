<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogComment extends Model{
    use HasFactory;
    protected $table = "blog_comment";
    public $timestamps = false;

    public function blog(): BelongsTo{
        return $this->belongsTo(Blog::class, "blogId", "id");
    }

    public function customer(): BelongsTo{
        return $this->belongsTo(Customer::class, "customerId", "id");
    }
}
