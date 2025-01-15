<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FailedPayment extends Model{
    use HasFactory;
    protected $table = "failed_payment";
    public $timestamps = false;
}
