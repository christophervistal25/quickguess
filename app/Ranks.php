<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Builder;


class Ranks extends Model
{
    public $timestamps  = false;
    protected $fillable = ['username','points'];

    protected static function boot()
    {
        parent::boot();
        // Order by points desc
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('points', 'desc');
        });
    }
    public static function checkUser(string $username) : bool
    {
        return Ranks::where('username',$username)->exists();
    }

    public static function getCredentials(string $username)
    {
        return Ranks::where('username',$username)->first();
    }

   public static function createUserWithPoints(array $user_data = [])
    {
        $user_rank_info = self::create([
           'username' => $user_data['username'],
           'points'   => $user_data['points'],
        ]);
       return response()->json(['points' => $user_rank_info['points']]);

}
    public static function updateUserPoints(array $data = [])
    {
        $user_rank_info = self::getCredentials($data['username']);
        $user_rank_info->increment('points',$data['points']);
        return response()->json([
            'points'   => $user_rank_info->points,
        ]);
    }
}
