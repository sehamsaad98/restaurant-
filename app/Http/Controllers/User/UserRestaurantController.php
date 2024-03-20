<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantResource;
use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class UserRestaurantController extends Controller
{
    public function activeRestaurants(){

        $activeRestaurants = Restaurant::where('status', 'active')->get();
        return RestaurantResource::collection($activeRestaurants);

    }



    public function getRestaurantMenu($restaurantId)
    {
        $menus = Menu::where('restaurant_id', $restaurantId)->get();

        return response()->json($menus);


    }
}
