<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/home';
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function register(Request $request){
        return view('auth/register');
    }

    public function create(Request $request){
        $data = [
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => $request -> password,
         ];
       if(validator(
            $data
        )->fails()){
            
            return redirect()->route('register') // Redirect to register route
      ->withErrors([ // Pass error message to flash session
        'email' => 'validation failed']);

        }else{
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'isadmin' => 0,
                'password' => Hash::make($data['password']),
            ]);
            return redirect()->route('home');
        };
        // creates($data);
    }

}
