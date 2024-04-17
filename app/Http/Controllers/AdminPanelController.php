<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class AdminPanelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function login(Request $request){
        $dataofuser = User::all();
        return view('adminpanel/home', compact('dataofuser'));
    }

    public function useredit($id){
        $userlistfromdatabase = User::find($id);
        return view('adminpanel/useredit',compact('userlistfromdatabase'));
    }
    public function userupdate(Request $request, $id){
        if($request->input('password')!=null){
            $VALIDATOR= Validator::make($request->all(),[
                'name'=>['required','string','max:255'],
                'password'=>['required','string','min:8','confirmed'],
            ]);
    }else{
        $VALIDATOR= Validator::make(['name'=>$request->input('name')],[
            'name'=>['required','string','max:255'],
        ]);
           
        }
         if($VALIDATOR->fails()){
             return redirect()->route('adminpaneluseredit',compact('id')) ->withErrors($VALIDATOR->errors())  //Pass all validation errors
             ->withInput();
         }else{
        $userlistfromdatabase  = User::find($id);
         $userlistfromdatabase->name = $request->input('name');
         if($request->input('password')){
            $userlistfromdatabase->password = $request->input('password');
         }
         
         $userlistfromdatabase->save();
         return redirect()->route('adminpanel')
         ->with('success', 'Record edited successfully!');
         }
        

    }

    public function userdelete(Request $request, $id){
        $user_to_be_deleted = User::find($id);
        if($user_to_be_deleted){
            $user_to_be_deleted->delete();
            return redirect()->route('adminpanel')
            ->with('success', 'Record deleted successfully!');
        }else{
           return redirect()->route('adminpanel')->with('failure', 'Record deleted failed. No user found.');
           ;
        }
    }
}