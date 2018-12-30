<?php
namespace App\Http\Requests;

use Urameshibr\Requests\FormRequest;
use App\Rules\UserDataValid;

class UserStatRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
           'username' => 'required',
           'data'     => ['required' , new UserDataValid()]
        ];
    }
}
?>