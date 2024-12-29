<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceFilter extends Model{
    use HasFactory;
    protected $table = "price_filter";
    public $timestamps = false;
}
