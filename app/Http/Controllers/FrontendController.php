<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Query;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index()
    {

        return view('frontend.home');
    }



}
