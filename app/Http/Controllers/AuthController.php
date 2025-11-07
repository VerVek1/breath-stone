<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function register(Request $request) {
        $request->validate([
            'full_name' => 'required|string',
            'login' => 'required|unique:employees',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,moderator,operator'
        ]);

        $employee = Employee::create([
            'full_name' => $request->full_name,
            'login' => $request->login,
            'password_hash' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return response()->json(['token' => $employee->createToken('api-token')->plainTextToken], 201);
    }
}