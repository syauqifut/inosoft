<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');

        if(!$token = auth()->attempt($credentials)){
            return response()->json(['error'=> ' invalid_credentials'], 401);
        }

        return (new UserResource($request->user()))
            ->additional(['meta' => [
                'token' => $token,
            ]]);
    }
}
