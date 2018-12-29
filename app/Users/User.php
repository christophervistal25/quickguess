<?php
namespace App\Users;


use App\Users\User;
use App\Users\UserStat;
use App\Users\UserSwitch;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Auth\Authorizable;


class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    public $timestamps = false;
    protected $fillable = ['name','password'];

     /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($pass) {
        $this->attributes['password'] = Hash::make($pass);
    }

    public function stat()
    {
        return $this->hasMany(UserStat::class,'user_id');
    }

     public function user_history()
    {
        return $this->hasOne(UserSwitch::class,'user_id');
    }

    public function jwt(User $user , int $expiration_time = null) {
        //31556926 is 1 year
        $time_token_will_expire = ($expiration_time) ? $expiration_time : time() + 31556926;
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => $time_token_will_expire,
        ];

        // As you can see we are passing `JWT_SECRET` as the second parameter that will
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    }

}