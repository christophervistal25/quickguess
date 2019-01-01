<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserHistoryRequest;
use App\Users\Repositories\UserHistoryRepository;
use Illuminate\Http\Request;

class UserHistoryController extends Controller
{

    public function __construct(UserHistoryRepository $userHistoryRepository)
    {
      $this->userHistoryRepository = $userHistoryRepository;
    }

   	 public function store(UserHistoryRequest $request)
     {
        return $this->userHistoryRepository
                    ->addUserHistory($request->all());
     }
}
