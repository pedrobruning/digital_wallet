<?php


namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use App\Http\Requests\AuthenticationRequest;
use App\Http\Requests\RegistrationRequest;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegistrationRequest $request)
    {
        $attributes = $request->validated();
        return $this->userRepository->save($attributes);
    }

    public function authenticate(AuthenticationRequest $request)
    {
        $attributes = $request->validated();

        return $this->userRepository->authenticate($attributes);

    }
}
