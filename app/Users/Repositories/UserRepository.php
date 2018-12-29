<?php
namespace App\Users\Repositories;

use App\Users\Exceptions\CreateUserErrorException;
use App\Users\Repositories\UserStatRepository;
use App\Users\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
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
        try {
            return $this->model->create(
                [
                    'name' => $data['username'],
                    'password' => $data['password']
                ]
            );
        } catch (QueryException $e) {
            throw new CreateUserErrorException($e);
        }
    }

    /**
     * [findUser description]
     * @param  int    $id [description]
     * @return [type]     [description]
     */
    public function findUser(int $id) : User
    {
        try {
            return $this->model->findOrFail($id);
        } catch (QueryException $e) {
            throw new CreateUserErrorException($e);
        }
    }

    /**
     * [findUserByName description]
     * @param  string $username [description]
     * @return [type]           [description]
     */
    public function findUserByName(string $username) : User
    {
        try {
            return $this->model->where('name',$username)->first();
        } catch (QueryException $e) {
            throw new CreateUserErrorException($e);
        }
    }

    public function findUserStat(string $username) : User
    {
           try {
           return $this->model->where('name',$username)
                        ->with(['stat','user_history'])
                        ->first();
        } catch (QueryException $e) {
            throw new CreateUserErrorException($e);
        }
    }

    /**
     * [login description]
     * @param  array  $data [description]
     * @return [type]       [description]
     */
    public function login(array $data)
    {
        $user = $this->model->where('name',$data['username'])->first();
        if (isset($user) && Hash::check($data['password'],$user->password)) {
            return response()->json(
                [
                    'success' => true,
                    'id' => $user->id ,
                    'name' => $user->name,
                    'token' => $this->model->jwt($user) ,
                    'stat' => $user->stat,
                    'user_history' => $user->user_history
                ],200);
        }
        return response()->json(['success' => false],422);
    }

    public function register(array $data)
    {
        $new_user = $this->createUser($data);
        if ($new_user) {
            return response()->json([
                'success' => true,
                'id' => $new_user->id,
                'token' => $this->model->jwt($new_user)
            ],201);
        }
    }


}
