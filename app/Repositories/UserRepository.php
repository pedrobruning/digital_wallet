<?php


namespace App\Repositories;


use App\Exceptions\WrongCredentialsException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository
{

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function authenticate(array $credentials)
    {
        throw_if(!Auth::attempt($credentials), new WrongCredentialsException());
        return auth()->user()->createToken('api-token');
    }
}
