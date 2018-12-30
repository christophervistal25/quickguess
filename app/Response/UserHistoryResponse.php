<?php
namespace App\Response;


trait UserHistoryResponse
{

    /**
     * [respondAddingUserHistoryFailed description]
     * @param  string      $message    [description]
     * @param  int|integer $statusCode [description]
     * @return [type]                  [description]
     */
    public function respondAddingUserHistoryFailed(string $message = "user not exists." , int $statusCode = 422)
    {
       return response()->json(['code' => $statusCode , 'message' => $message],$statusCode);
    }

    /**
     * [respondAddingUserHistorySuccess description]
     * @param  int|integer $statusCode [description]
     * @return [type]                  [description]
     */
    public function respondAddingUserHistorySuccess(int $statusCode = 201) {
        return response()->json(['code' => $statusCode],$statusCode);
    }
}
