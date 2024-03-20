<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OderDetails extends Model
{
    use HasFactory;

    protected $fillable = [  'order_id','menu_id', 'quantity', 'price'];
    protected $table = 'oder_details';
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
