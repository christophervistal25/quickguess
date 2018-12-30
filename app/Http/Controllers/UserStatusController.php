<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStatRequest;
use App\Users\Repositories\UserStatRepository;
use App\Users\UserStat;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{

    protected $userRepo;
    protected $user_stat;
    public function __construct(UserStatRepository $userStatRepository)
    {
        $this->userStatRepository = $userStatRepository;
    }
   	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => UserStat::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStatRequest $request)
    {
        return $this->userStatRepository
                    ->addUserStatusForEveryQuestion($request->all());
    }


}
