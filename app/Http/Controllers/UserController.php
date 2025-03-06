<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Dedoc\Scramble\Attributes\Security;


class UserController extends Controller
{
    public function __construct() {
        
    }
    
    
    /**
    * Get All User.
    * @response User[]
    */
    
    public function index()
    {
        return response()->json(User::all());
    }

    /**
    * Show User.
    * @response User
    */
    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    /**
    * Store User.
    * @response User
    */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user, 201);
    }

    /**
    * Update User.
    * @response User
    */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user);
    }
    /**
     * Destory User.
     * @response message:string
     */    
    public function destroy($id)
    {
        $user = auth('api')->user();

        if ($user->id == $id) {
            return response()->json(['message' => 'You cannot delete your own account.'], 403);
        }

        User::destroy($id);
        return response()->json(['message' => 'User deleted']);
    }

}
