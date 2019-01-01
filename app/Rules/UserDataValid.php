<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UserDataValid implements Rule
{

    /**
     * [isJson description]
     * @param  [type]  $string [description]
     * @return boolean         [description]
     */
    private function isJson($value)
    {
        if (is_array($value)) {
            return false;
        } else if($value == "[{}]") {
            return false;
        } else {
            $json = json_decode($value,true);
        }
        return ($json && $value != $json);
    }

     /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->isJson($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is not valid.';
    }
}
