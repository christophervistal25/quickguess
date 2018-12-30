<?php
namespace App\Users\Repositories;

use App\Users\Repositories\UserStatRepository;
use App\Users\User;
use Illuminate\Support\Facades\Hash;
use App\Response\UserResponse;

class UserRepository
{
    use UserResponse;
    /**
     * [__construct description]
     * @param User $user [description]
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * [createUser description]
     * @param  array  $data [description]
     * @return [type]       [description]
     */
    public function createUser(array $data) : User
    {
        return $this->model->create(
                [
                    'name'     => $data['username'],
                    'password' => $data['password']
                ]
            );
    }

    /**
     * [findUser description]
     * @param  int    $id [description]
     * @return [type]     [description]
     */
    public function findUser(int $id) : User
    {
       return $this->model->findOrFail($id);
    }

    /**
     * [findUserByName description]
     * @param  string $username [description]
     * @return [type]           [description]
     */
    public function findUserByName(string $username) : User
    {
        return $this->model->where('name',$username)->first();
    }

    /**
     * [findUserStat description]
     * @param  string $username [description]
     * @return [type]           [description]
     */
    public function findUserStat(string $username) : User
    {
        return $this->model->where('name',$username)
                    ->with(['stat','user_history'])
                    ->first();
    }

    /**
     * [login description]
     * @param  array  $data [description]
     * @return [type]       [description]
     */
    public function login(array $data)
    {
        $player = $this->findUserByName($data['username']);
        if (isset($player) && Hash::check($data['password'],$player->password)) {
            return $this->respondUserSuccessfullyLogin($player);
        }
        return $this->respondUserFailedToLogin();
    }

    /**
     * [register description]
     * @param  array  $data [description]
     * @return [type]       [description]
     */
    public function register(array $data)
    {
        return $this->respondUserSuccessfullyRegister($this->createUser($data));
    }




}

