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



}
