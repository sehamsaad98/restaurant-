<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [  'user_id', 'restaurant_id', 'menu_id', 'status'];
    protected $table = 'orders';
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function restaurant()
    {
        return $this->belongsTo(restaurant::class, 'restaurant_id');
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
