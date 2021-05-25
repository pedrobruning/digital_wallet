<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticationRequest;
use App\Http\Resources\AuthenticationResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function authenticate(AuthenticationRequest $request)
    {
        if(Auth::attempt($request->validated())) {
            return new AuthenticationResource(auth()->user()->createToken('api-token'));
        }
        return response(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
    }
}
