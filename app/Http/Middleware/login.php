<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Auth;

class login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $emailtyped = $request->email;
        $passtyped = $request->password;
        // check if database matches the email inputed by the user it will proceed
        if(User::Where("email",$emailtyped)->value('email')){
            
            // $comp = Hash::check($passtyped, $passfromdatabase);
            // checking user credentials and maintaining session
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                if(Auth::user()->isadmin==1){
                    return redirect()->route('adminpanel'); //admin panel
                }
                else{
                    return redirect()->route('home');//user panel
                    
                }
                
                // return redirect()->intended('dashboard')
                //     ->withSuccess('Signed in');
            }
            else{
                return redirect()->route('loginpage') // Redirect to login route
      ->withErrors([ // Pass error message to flash session
        'email' => 'The provided email or password is incorrect.',
      ]);
            }
            // return $next($request);

        }else{

            // return response(view('/welcome'));
            return redirect()->route('register') // Redirect to register route
      ->withErrors([ // Pass error message to flash session
        'email' => 'not registered',
      ]);

        }
    }
}
