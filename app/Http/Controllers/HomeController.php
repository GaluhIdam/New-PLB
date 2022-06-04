<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        return Activity::all();
    }

    public function index()
    {
        return view('home');
    }
}
