<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Admin;
use App\Models\Trader;
// use JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;


class AuthController extends Controller
{
    protected $jwtAuth;

    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }
///////////////////////////////////user auth  ///////////////////////////
public function userRegister(Request $request) {
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
    ]);

    $token = auth('user')->login($user);

    return response()->json([
        'message' => 'User successfully registered',
        'token' => $token
    ], Response::HTTP_CREATED);
}




public function userLogin(Request $request) {
    
    $credentials = $request->only(['email', 'password']);
    if (!$token = auth('user')->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
    }

    return response()->json(compact('token'));
}





///////////////////////////////////Trader  auth  ///////////////////////////
public function traderRegister(Request $request) {
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:traders',
        'password' => 'required|min:6',
    ]);

    $trader = Trader::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
    ]);

    $token = auth('trader')->login($trader);

    return response()->json([
        'message' => 'Trader successfully registered',
        'token' => $token
    ], Response::HTTP_CREATED);
}
//////////////////////
public function traderLogin(Request $request) {
    $credentials = $request->only(['email', 'password']);
    if (!$token = auth('trader')->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
    }

    return response()->json(compact('token'));
}

///////////////////////////////////Admin  auth  ///////////////////////////
public function adminRegister(Request $request) {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // Create the admin record
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // To  Set the status to 'inactive' by default
            'status' => 'inactive', 
        ]);

        // Return a success response
        return response()->json([
            'message' => 'Admin registered successfully',
            'admin' => $admin
        ], 201);
}


/////////////////

public function adminLogin(Request $request)
{
    $credentials = $request->only('email', 'password');

    try {
        if (!$token = auth('admin')->attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 400);
        }
    } catch (JWTException $e) {
        return response()->json(['error' => 'could_not_create_token'], 500);
    }

    return response()->json(compact('token'));
}



}
