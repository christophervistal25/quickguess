<?php
namespace App\Http\Requests;

use App\Rules\CheckUser;
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
          'username'       => ['required' , new CheckUser],
          'prev_user_life' => 'required',
          'game_over_time' => 'nullable',
        ];
    }
}
?>