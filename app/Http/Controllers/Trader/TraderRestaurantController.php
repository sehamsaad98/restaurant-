<?php

namespace App\Http\Controllers\Trader;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class TraderRestaurantController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            // Add validation for 'image' if necessary, e.g. 'image' => 'sometimes|file|image|max:10240'
        ]);
    
        $restaurant = new Restaurant();
        $restaurant->name = $request->name;
        $restaurant->address = $request->address;
        $restaurant->phone_number = $request->phone_number;
        // Properly handle the image file if necessary
        // $restaurant->image = $request->image;
    
        $restaurant->trader_id = auth()->id();; 
        $restaurant->save();
    
        return response()->json([
            'message' => 'Restaurant created successfully',
            'data' => $restaurant
        ], 201);
    }
}
