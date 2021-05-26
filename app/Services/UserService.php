<?php


namespace App\Services;

use App\Repositories\UserRepository;
use App\Http\Requests\AuthenticationRequest;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Support\Facades\Hash;

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
        $attributes['password'] = Hash::make($attributes['password']);
        return $this->userRepository->save($attributes);
    }

    public function authenticate(AuthenticationRequest $request)
    {
        $attributes = $request->validated();

        return $this->userRepository->authenticate($attributes);

    }
}
