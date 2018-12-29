<?php

namespace App\Users;
use App\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserSwitch extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id','prev_user_life','game_over_time'];

    public function user()
    {
        $this->primaryKey = 'user_id';
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function addUserHistory($user , Request $request)
    {
        return $this->updateOrCreate(['user_id' => $user->id],
            [
                 'user_id' => $user->id,
                 'prev_user_life' => $request->prev_user_life,
                 'game_over_time' => $request->game_over_time,
            ]);
    }
}
