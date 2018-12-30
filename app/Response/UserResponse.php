<?php
namespace App\Response;

use App\Users\User;
trait UserResponse
{
    /**
     * [respondUserSuccessfullyLogin description]
     * @param  User        $player     [need to pass a instance of a user]
     * @param  int|integer $statusCode [status code of the response]
     * @return [type]                  [description]
     */
    public function respondUserSuccessfullyLogin(User $player,int $statusCode = 200)
    {
        return response()->json([
            'success'      => true,
            'id'           => $player->id ,
            'name'         => $player->name,
            'token'        => $player->jwt($player),
            'stat'         => $player->stat,
            'user_history' => $player->user_history
        ],$statusCode);
    }

    /**
     * [respondUserFailedToLogin description]
     * @param  int|integer $statusCode [description]
     * @return [type]                  [description]
     */
    public function respondUserFailedToLogin(int $statusCode = 422)
    {
        return response()->json(['success' => false],$statusCode);
    }

    /**
     * [respondUserSuccessfullyRegister description]
     * @param  User        $new_player [description]
     * @param  int|integer $statusCode [description]
     * @return [type]                  [description]
     */
    public function respondUserSuccessfullyRegister(User $new_player , int $statusCode = 201)
    {
         return response()->json([
            'success' => true,
            'id'      => $new_player->id,
            'token'   => $new_player->jwt($new_player),
         ],$statusCode);
    }
}
