<?php
namespace App\Rules;

use App\Users\User;
use Illuminate\Contracts\Validation\Rule;

class CheckUser implements Rule
{

     /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return User::where('name',$value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'the user is unauthorized.';
    }
}
