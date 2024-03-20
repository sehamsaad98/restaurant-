<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Trader\TraderRestaurantController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TraderController;
use App\Http\Controllers\Trader\TraderMenuController;
use App\Http\Controllers\User\UserRestaurantController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register/user', [AuthController::class, 'userRegister']);
Route::post('/register/admin', [AuthController::class, 'adminRegister']);
Route::post('/register/trader', [AuthController::class, 'traderRegister']);
Route::post('user/login', [AuthController::class , 'userLogin']);
Route::post('admin/login', [AuthController::class , 'adminLogin']);
Route::post('trader/login', [AuthController::class , 'traderLogin']);



/////////////// Admin routes Starts ///////////////////
Route::middleware('auth:admin')->group(function () {
//// trader routes
Route::get('admin/traders', [TraderController::class, 'allTraders']);
Route::patch('admin/trader/{trader}/status', [TraderController::class, 'updateStatus']);
//// users routes
Route::get('admin/users', [AdminController::class, 'allUsers']);
//// restaurants routes
Route::get('admin/restaurants', [RestaurantController::class, 'index']);    
Route::patch('admin/restaurant/{id}/status', [RestaurantController::class, 'updateStatus']);
//// Menu routes

});
/////////////// Admin routes Ends ///////////////////

/////////////// user routes Start ///////////////////
Route::middleware('auth:user')->group(function () {
 Route::get('restaurants', [UserRestaurantController::class, 'activeRestaurants']);
 Route::get('/restaurants/{restaurantId}/menus', [UserRestaurantController::class, 'getRestaurantMenu']);


});
/////////////// user routes Ends ///////////////////

/////////////// Trader routes Start ///////////////////

Route::middleware('auth:trader')->group(function () {
    Route::post('menus', [TraderMenuController::class, 'store']);
    Route::post('restaurants', [TraderRestaurantController::class, 'store']);

});
/////////////// Trader routes Ends ///////////////////



