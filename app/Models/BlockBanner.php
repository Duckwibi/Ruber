<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockBanner extends Model{
    use HasFactory;
    protected $table = "block_banner";
    public $timestamps = false;
}
