<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Http\Response;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all restaurant from database
        $restaurants = Restaurant::all();
        if ($restaurants->isEmpty()) {
            return response()->json([
                'message' => 'No restaurants found',
                'data' => $restaurants,
            ], Response::HTTP_NOT_FOUND); // 404 status code
        }
    
        return response()->json([
            'message' => 'Restaurants retrieved successfully',
            'data' => $restaurants,
        ], Response::HTTP_OK); // 200 status code
        }

        public function updateStatus(Request $request, $id)
        {
               $resturant = Restaurant::findOrFail($id);// Find the resturant or fail with a 404 
               // Validate the status
               $request->validate([
                   'status' => 'required|in:active,inactive', 
               ]);
               $resturant->status = $request->status; // Set the status to 'active'
               $resturant->save(); // Save the resturant
           
               return response()->json([
                   'message' => 'resturant status updated successfully!',
                   'resturant' => $resturant
               ]);
        }
}
