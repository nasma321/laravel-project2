<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class MainController extends Controller
{
    public function userLogin(Request $request){
        $user = User::where('email','=',$request->email)->first();
        if($user){
            Auth::loginUsingId($user->id, TRUE);
            if(Auth::check()){
                \Log::info(Auth::user());
                return response()->json(['status'=>true]);
            }else return response()->json(['status'=>false]);
        }
        
    }

    function index()
    {
     return view('login');
    }

    public function getDash(Request $request){
        return view('success2');
    }

    function checklogin(Request $request)
    {
     $this->validate($request, [
      'email'   => 'required|email',
      'password'  => 'required|alphaNum'
     ]);

     $user_data = array(
      'email'  => $request->get('email'),
      'password' => $request->get('password')
     );

     if(Auth::attempt($user_data))
     {
      return redirect('main/successlogin');
     }
     else
     {
      return back()->with('error', 'Wrong Login Details');
     }

    }

    function successlogin()
    {
        return view('success');
    }

    function logout()
    {
     Auth::logout();
     return redirect('login');
    }

}
