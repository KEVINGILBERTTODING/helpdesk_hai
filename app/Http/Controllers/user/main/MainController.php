<?php

namespace App\Http\Controllers\user\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    function index()
    {
        return view('user.main.dashboard');
    }
}
