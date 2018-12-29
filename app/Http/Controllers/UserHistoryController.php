<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserHistoryRequest;
use App\Users\User;
use App\Users\UserSwitch;
use Illuminate\Http\Request;

class UserHistoryController extends Controller
{

    public function __construct(UserSwitch $user_switch)
    {
        $this->model = $user_switch;
    }

   	 public function store(UserHistoryRequest $request)
     {
          $player = User::where('name',$request->username)->first();
          if ($player) {
              $user_history = $this->model->addUserHistory($player,$request);
              $player->user_history()->save($user_history);
              return response()->json(['code' => 201],201);
          } else {
              return response()->json(['code' => 422 , 'message' => 'user not exists.'],422);
          }
     }
}
