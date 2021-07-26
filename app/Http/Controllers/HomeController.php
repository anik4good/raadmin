<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{


    public function index()
    {
        return view('home');
    }

    public function clearCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        notify()->success('All cache Successfully Cleared.', 'Success');
        return redirect()->back();
    }
}
