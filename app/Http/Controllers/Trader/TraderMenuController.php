<?php

namespace App\Http\Controllers\Trader;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class TraderMenuController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' =>'required|numeric',
        ]);
    
        // Check if the restaurant belongs to the authenticated trader
        $restaurant = Restaurant::where('id', $request->restaurant_id)
                                ->where('trader_id', $request->user()->id)
                                ->first();
    
        if (!$restaurant) {
            return response()->json(['message' => 'Unauthorized to add menu to this restaurant'], 403);
        }
    
        // Create the menu item
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->restaurant_id  = $restaurant->id;
        $menu->save();
    
        return response()->json(['message' => 'Menu item added successfully', 'data' => $menu], 201);
    }
    


    public function getMenuItems(Request $request)
    {
        $traderId = $request->user()->id; 
        $menus = Menu::where('trader_id', $traderId)->get();

        return MenuResource::collection($menus);
    }
}
