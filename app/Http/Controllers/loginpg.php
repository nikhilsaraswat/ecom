<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
class loginpg extends Controller
{
    public function login()
    {
        return view('/auth/login');
    }

}
