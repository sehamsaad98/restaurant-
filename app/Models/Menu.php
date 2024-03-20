<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    
    protected $fillable = [  'restaurant_id', 'description', 'price', 'image'];
    protected $table = 'menus';
     
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
    
    public function orderDetails()
    {
        return $this->hasMany(OderDetails::class,'menu_id');
    }






}
