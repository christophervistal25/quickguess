<?php
namespace App\Http\Requests;

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
          'username' => 'required',
          'password' => 'required',
        ];
    }
}
?>