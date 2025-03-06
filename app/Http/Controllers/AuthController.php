<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Registration API
     * @unauthenticated
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('authToken')->accessToken;

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    
    /**
     * Login API
     *
     * @unauthenticated
     */

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            /**
             * The email address of the user.
             * @var string
             * @example "abbas@example.com"
             */
            'email' => 'required|email',
        
            /**
             * The user's password.
             * @var string
             * @example "password"
             */
            'password' => 'required',
        ]);
        

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Wrong Email or Password'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            /**
             * @var User
             */
            'user' => $user, 
            /**
             * @var string
             */
            'token' => $token], 
            200);
    }

    /**
     * Logout API
     */
    public function logout()
    {
        Auth::user()->token()->revoke();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
