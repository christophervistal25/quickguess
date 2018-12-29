<?php
namespace App\Http\Requests;

use Urameshibr\Requests\FormRequest;

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
           'data'     => 'required'
        ];
    }
}
?>