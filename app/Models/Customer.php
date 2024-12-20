<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Authenticatable{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "customer";
    public $timestamps = false;

    public function blogComments(): HasMany{
        return $this->hasMany(BlogComment::class, "customerId", "id");
    }
}
