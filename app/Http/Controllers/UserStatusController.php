<?php

namespace App\Http\Controllers;

use App\Events\GetPoints;
use App\Http\Requests\UserStatRequest;
use App\Users\Repositories\UserRepository;
use App\Users\Repositories\UserStatRepository;
use App\Users\User;
use App\Users\UserStat;
use Exception;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{

    protected $userRepo;
    protected $user_stat;
    public function __construct(UserStatRepository $user_repo, UserStat $user_stat)
    {
        $this->userStatRepo = $user_repo;
        $this->user_stat = $user_stat;
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
        return $this->userStatRepo->createUserStat($request->all());
    }


}
