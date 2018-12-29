<?php
namespace App\Users\Repositories;

use App\Users\User;
use App\Users\UserStat;
use App\Events\GetPoints;
use App\Users\Repositories\UserRepository;


class UserStatRepository
{

    public function __construct(UserStat $user_stat , UserRepository $userRepository)
    {
        $this->model = $user_stat;
        $this->userRepository = $userRepository;
    }

    /**
     * [createUserStat insert new user stat for a user/player]
     * @return [type] [description]
     */
    public function createUserStat(array $items)
    {
        $user = User::where('name',$items['username'])->first();
            if (! $user ) {
                 return response()->json(['code' => 422 , 'message' => 'unauthorized'],422);
            }
            $user_status = json_decode(stripslashes($items['data']),true);
            $status = $this->model->checkBeforeInsert($user_status,$user->id);
            $user->stat()->saveMany($status);
            \Event::fire( new GetPoints($user->id,$user->name));
            return response()->json(['code' => 201 , 'message' => 'authorized'],201);
    }


}
