<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Trader extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'email_verified_at', 'password', 'status'];
    protected $hidden = ['password'];
    
    protected $table = 'traders';

    public function restaurants() // Renamed for clarity and convention
    {
        return $this->hasMany(Restaurant::class, 'trader_id');
    }



    ////////////////////////// jwt ///////////////////// 
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}

