<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\RegisterUserResponse;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        // Create a new user instance
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->Phone = $request->input('Phone');
        $user->Status = 1;

        // Save the user
        $user->save();

        // Generate a token for the user
        $token = Auth::login($user);

        return new RegisterUserResponse($user);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);
    
        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        Auth::user()->tokens->each(function($token) {
            $token->delete();
        });
    
        return $this->respondWithToken($token);
    }
    

    public function me()
    {
        return response()->json(Auth::user());
    }
    public function logout()
    {
        
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
        ]);
    }
}
