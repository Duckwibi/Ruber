<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model{
    use HasFactory;
    protected $table = "archive";
    public $timestamps = false;
}