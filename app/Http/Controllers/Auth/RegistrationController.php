<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\RegistrationResource;
use App\Models\User;

class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $user = User::create($request->validated());
        return new RegistrationResource($user);
    }
}
