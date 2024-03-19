<?php

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use Symfony\Component\HttpFoundation\Response;

// class UserController extends Controller
// {
//     public function register(Request $request) {
//         $validatedData = $request->validate([
//             'name' => 'required|max:255',
//             'email' => 'required|email|unique:users',
//             'password' => 'required|min:6',
//         ]);

//         $user = User::create([
//             'name' => $validatedData['name'],
//             'email' => $validatedData['email'],
//             'password' => Hash::make($validatedData['password']),
//         ]);

//         $token = auth('api-user')->login($user);

//         return response()->json([
//             'message' => 'User successfully registered',
//             'token' => $token
//         ], Response::HTTP_CREATED);
//     }
// }
