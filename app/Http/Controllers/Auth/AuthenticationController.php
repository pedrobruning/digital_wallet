<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\WrongCredentialsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticationRequest;
use App\Http\Resources\AuthenticationResource;
use App\Services\UserService;
use Illuminate\Http\Response;

class AuthenticationController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function authenticate(AuthenticationRequest $request)
    {
        try {
           $token = $this->userService->authenticate($request);
        } catch (WrongCredentialsException $exception) {
            abort(Response::HTTP_UNAUTHORIZED, 'Unable to Authenticate User');
        }
        return new AuthenticationResource($token);
    }
}
