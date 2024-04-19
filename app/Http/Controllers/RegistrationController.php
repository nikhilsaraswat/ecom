<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use File;
class RegistrationController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/home';
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request){
        return view('auth/register');
    }

    public function create(Request $request){

        $VALIDATOR= Validator::make($request->all(),[
            'name'=>['required','string','max:255'],
      
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
       
            'password'=>['required','string','min:8','confirmed'],
            'image' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
        ]);

         if($VALIDATOR->fails()){
             return redirect()->route('register')  //Redirect to register route
             ->withErrors($VALIDATOR->errors())  //Pass all validation errors
         ->withInput();
         }else{
            $image = $request->file('image');
            if($request->file('image')==null){
                $imageName= "1713428191.png";
            }else{
            $imageName = time() . '.' . $image->getClientOriginalExtension();}
            Storage::disk('local')->put('/public/images/' . $imageName, File::get($image));

            User::create([
                      'name' => $request->name,
                      'email' => $request->email,
                      'isadmin' => 0,
                      'image' => $imageName,
                      'password' => Hash::make($request->password),
                  ]);
                   return redirect()->route('loginpage')
           ->with('success', 'user added successfully!');
            }
    }

}
