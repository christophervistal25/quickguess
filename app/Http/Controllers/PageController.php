<?php

namespace App\Http\Controllers;
use App\Ranks;
use App\Users\UserStat;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $ranks;
    public function __construct(Ranks $ranks)
    {
        $this->ranks = $ranks;
    }

    public function index()
    {
        $ranks = $this->ranks->get();
        return view('index',compact('ranks'));
    }

}
