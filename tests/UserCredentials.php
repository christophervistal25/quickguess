<?php

use Illuminate\Support\Facades\Hash;

trait UserCredentials
{
    public $credentials = [];

    /**
     * [credentials setup a value for credentials properties]
     * @return [type] [return the object instance]
     */
    public function credentials()
    {
        $this->credentials = [
            'username' => $this->user->name,
            'password' => 1234,
            'token'    => $this->user->jwt($this->user)
         ];
        return $this;
    }

    /**
     * [refreshUsername set up new value for username]
     * @return [type] [return the object instance]
     */
    public function refreshUsername()
    {
        $this->credentials['username'] = $this->faker->username;
        return $this;
    }

    /**
     * [hashThePassword hash the value of password]
     * @return [type] [return the object instance]
     */
    public function hashThePassword()
    {
        $this->credentials['password'] = Hash::make($this->credentials['password']);
        return $this;
    }

    /**
     * [withoutToken eliminate the token in credentials property]
     * @return [type] [return the object instance]
     */
    public function withoutToken()
    {
        array_walk($this->credentials, function (&$value , $key) {
            if ($key === 'token') { unset($this->credentials[$key]); }
        });
        return $this;
    }


    /**
     * [setTheTokenToExpire description]
     */
    public function setTheTokenToExpire()
    {
        $this->credentials['token'] = $this->user->jwt($this->user,60);
        return $this;
    }

    /**
     * [withNull set a null]
     * @param  array  $fields [you can either pass an array or a string]
     * @return [type]         [return the object instance]
     */
    public function withNull($fields = [])
    {
        if(is_array($fields)) {
            foreach ($fields as $value) {
                $this->credentials[$value] = null;
            }
        } else {
            $this->credentials[$fields] = null;
        }
        return $this;
    }

    public function userHistoryCredentials()
    {
        $this->credentials = [
            'username'       => $this->user->name,
            'prev_user_life' => $this->faker->randomDigit,
            'game_over_time' => $this->faker->randomDigit,
            'token'          => $this->user->jwt($this->user),
        ];
        return $this;
    }

    public function userStatusCredentials()
    {
        $this->credentials = [
            'username' => $this->user->name,
            'data'     => json_encode($this->user_data_status),
            'token'    => $this->user->jwt($this->user),
        ];
        return $this;
    }

    public function decodeJsonStatus()
    {
        $this->credentials['data'] = json_decode($this->user_data_status,true);
        return $this;
    }


    /**
     * [getAll get the modified values of the credential property]
     * @return [type] [return the credential property]
     */
    public function getAll()
    {
        return $this->credentials;
    }

}

?>