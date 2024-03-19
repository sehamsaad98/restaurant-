<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trader;
use Illuminate\Http\Request;
use App\Http\Resources\TradersResource;


class TraderController extends Controller
{
    public function allTraders()
    {
        $users = Trader::all ();
        return TradersResource::collection($users);
    }




     public function updateStatus(Request $request, $trader)
     {
            $trader = Trader::findOrFail($trader);// Find the trader or fail with a 404 
            // Validate the status
            $request->validate([
                'status' => 'required|in:active,inactive', 
            ]);
            $trader->status = $request->status; // Set the status to 'active'
            $trader->save(); // Save the trader
        
            return response()->json([
                'message' => 'Trader status updated successfully!',
                'trader' => $trader
            ]);
     }
}
