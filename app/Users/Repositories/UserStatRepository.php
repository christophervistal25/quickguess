<?php
namespace App\Users\Repositories;

use App\Users\Repositories\UserRepository;
use App\Users\Repositories\UserStatRepository;
use Illuminate\Support\Facades\DB;
use App\Events\GetPoints;
use App\Users\UserStat;
use App\Users\User;


class UserStatRepository
{

    public function __construct(UserStat $user_stat , UserRepository $userRepository)
    {
        $this->model = $user_stat;
        $this->userRepository = $userRepository;
    }

    /**
     * [addUserStatusForEveryQuestion description]
     * @param array $user_data [description]
     */
    public function addUserStatusForEveryQuestion(array $user_data)
    {
       $data = json_decode($user_data['data'],true);
         try {
            DB::beginTransaction();
                $user = $this->userRepository
                            ->findUserByName($user_data['username']);
                $insertedStatus = $this->insertStatus($user->id,$data);
                $this->attachTheStatusToAUser($insertedStatus,$user);
                \Event::fire( new GetPoints($user->id,$user->name));
            DB::commit();
            return response()->json(['code' => 201 , 'message' => 'authorized'],201);
        } catch (\PDOException $e) {
            DB::rollBack();
        }

    }

    private function insertStatus(int $user_id , array $user_data)
    {
        return $this->model->checkBeforeInsert($user_data, $user_id);
    }

    private function attachTheStatusToAUser($insertedStatus ,User $user)
    {
        return $user->stat()->saveMany($insertedStatus);
    }


}
