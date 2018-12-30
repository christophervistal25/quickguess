<?php
namespace App\Users\Repositories;

use App\Response\UserHistoryResponse;
use App\Users\Repositories\UserRepository;
use App\Users\User;
use App\Users\UserSwitch;
use Exception;
use Illuminate\Support\Facades\DB;

class UserHistoryRepository
{
    use UserHistoryResponse;

    /**
     * [__construct description]
     * @param UserSwitch $user_switch [description]
     * @param User       $user        [description]
     */
    public function __construct(UserSwitch $user_switch , UserRepository $userRepository)
    {
        $this->model = $user_switch;
        $this->userRepository = $userRepository;
    }



    /**
     * [addUserHistory description]
     * @param array $data [description]
     */
    public function addUserHistory(array $data)
    {
        try {
            DB::beginTransaction();
             $user = $this->userRepository->findUserByName($data['username']);
             $history_data =  $this->updateOrInsertHistory($user,$data);
             return $this->attachHistoryToTheUser($user,$history_data);
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
        }

    }

    /**
     * [updateOrInsertHistory description]
     * @param  User   $player [description]
     * @param  array  $data       [description]
     * @return [type]             [description]
     */
    private function updateOrInsertHistory(User $player , array $data)
    {
        return $this->model->updateOrCreate(['user_id' => $player->id],
            [
                'user_id'        => $player->id,
                'prev_user_life' => $data['prev_user_life'],
                'game_over_time' => $data['game_over_time'],
            ]
        );
    }

    /**
     * [attachHistoryToTheUser description]
     * @param  User   $user              [description]
     * @param  [type] $user_history_data [description]
     * @return [type]                    [description]
     */
    private function attachHistoryToTheUser(User $user , $user_history_data)
    {
        if ($user->user_history()->save($user_history_data)) {
            return $this->respondAddingUserHistorySuccess();
        }
    }

}
