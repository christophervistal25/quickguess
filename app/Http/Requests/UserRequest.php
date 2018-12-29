<?php
namespace App\Http\Requests;

use Urameshibr\Requests\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
           'username' => 'unique:users,name|required',
           'password' => 'required|max:20'
        ];
    }
}
?>