<?php
namespace App\Http\Requests;

use Urameshibr\Requests\FormRequest;

class UserHistoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          'username'       => 'required',
          'prev_user_life' => 'required',
          'game_over_time' => 'nullable',
        ];
    }
}
?>