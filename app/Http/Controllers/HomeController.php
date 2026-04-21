<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Spatie\Ignition\register;

class HomeController extends Controller
{
    public function index(){
        return view('user.dashboard');
    }
}
