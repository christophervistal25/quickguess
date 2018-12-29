<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Ranks;
use Illuminate\Http\Request;

class RanksController extends Controller
{
    private $ranks;
    public function __construct(Ranks $ranks)
    {
       // $this->middleware('jwt', ['except' => ['index']]);
        $this->ranks = $ranks->orderBy('points','DESC')->get();
    }

    public function ranks()
    {
        return response()->json($this->ranks);
    }
}
