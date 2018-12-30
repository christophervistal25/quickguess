<?php
namespace App\Http\Requests;

use App\Rules\CheckUser;
use Urameshibr\Requests\FormRequest;

class UserLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          'username' => ['required', new CheckUser],
          'password' => 'required',
        ];
    }
}
?>