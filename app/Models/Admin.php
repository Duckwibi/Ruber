<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin extends Authenticatable{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "admin";
    public $timestamps = false;
    public function blogs(): HasMany{
        return $this->hasMany(Blog::class, "adminId", "id");
    }
    protected $hidden = [
        "email",
        "password"
    ];
}
