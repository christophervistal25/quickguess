<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use App\Users\User;
use App\User\UserSwitch;
use App\Users\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $user , $userRepo;

    public function __construct(User $user , UserRepository $userRepo)
    {
        $this->user = $user;
        $this->userRepo = $userRepo;
    }

    public function store(UserRequest $request)
    {
        return $this->userRepo->register($request->all());
    }

    public function loginUser(UserLoginRequest $request)
    {
        return $this->userRepo->login($request->all());
    }


}
