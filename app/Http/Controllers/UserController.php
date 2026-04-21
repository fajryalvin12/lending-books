<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function store(Request $request) {

        // validasi input 
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8'
        ]);

        // hash password
        $hashed = Hash::make($validated['password'], [
            'rounds' => 12,
        ]);

        // kirim ke model 
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $hashed
        ]);

        // return response
        return response()->json([
            'success' => true,
            'message' => "Creating new user",
            'data' => $user
        ]);
    }

    public function index() {
        $users = User::all();

        return response()->json([
            'success' => true,
            'message' => "List all users",
            'data' => $users
        ], 200);
    }
}
