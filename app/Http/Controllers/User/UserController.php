<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {       
        $user = User::create([
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User created successfully!',
            'user' => $user
        ], 201);
    }
}
