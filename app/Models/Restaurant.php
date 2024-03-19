<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'phone_number', 'address', 'status', 'trader_id', 'image'];
    protected $table = 'restaurants';
    public function trader()
    {
        return $this->belongsTo(Trader::class, 'trader_id');
    }
    public function order()
    {
        return $this->hasMany(Order::class, 'restaurant_id');
    }
    public function menu()
    {
        return $this->hasMany(Menu::class, 'restaurant_id');
    }

}
