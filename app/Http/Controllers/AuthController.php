<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('App\Http\Middleware\login')->except('logout');
    }
    public function logout(Request $request)
    {
      Auth::logout();
    
      // Optional: Destroy the session for added security
      $request->session()->invalidate();
    
      $request->session()->regenerateToken(); // Optional: Regenerate CSRF token for added security
    
      return redirect()->route('home'); // Redirect to desired route after logout
    }
    public function login(Request $request){
        return view('userpanel/home');
    }
}
