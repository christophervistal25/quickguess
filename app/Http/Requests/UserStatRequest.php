<?php
namespace App\Http\Requests;

use Urameshibr\Requests\FormRequest;
use App\Rules\UserDataValid;
use App\Rules\CheckUser;

class UserStatRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
           'username' => ['required',new CheckUser()],
           'data'     => ['required' , new UserDataValid()]
        ];
    }
}
?>