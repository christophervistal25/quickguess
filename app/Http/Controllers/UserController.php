<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use App\Users\Repositories\UserRepository;

class UserController extends Controller
{

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store(UserRequest $request)
    {
        return $this->userRepository
                    ->register($request->all());
    }

    public function loginUser(UserLoginRequest $request)
    {
        return $this->userRepository
                    ->login($request->all());
    }


}
