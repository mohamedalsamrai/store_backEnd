<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\VerifyEmail;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

      
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

      

        $user->notify(new VerifyEmail($user)); 

        return response()->json(['message' => 'User registered successfully. A verification email has been sent.'], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember' => 'boolean', 
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

       
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

       
        $token = $user->createToken('token-name')->plainTextToken;

       
        return response()->json(['token' => $token]);
    }
    public function verifyEmail(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        if (!hash_equals((string) sha1($user->email), (string) $request->hash)) {
            return view('auth.verification_failed'); 
        }
    
        $user->email_verified_at = now();
        $user->save();
    
        return view('auth.verification_success'); 
    }
}