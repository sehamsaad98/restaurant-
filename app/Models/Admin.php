<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = [  'name', 'email',  'password', 'admin_level', 'active'];
    protected $hidden = ['password'];

    protected $table = 'admins';


////////////////////////jwt 
public function getJWTIdentifier() {
    return $this->getKey();
}

public function getJWTCustomClaims() {
    return [];
}

}
