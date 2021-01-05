<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Hash;
use Session;
use Auth;
use DB;



class signupController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function signup(Request $request)
    {

        ///valdition

        $this->Validate($request, [
            'name' => 'required|unique:users',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        //////store users
        //////////check if exists
        $user= DB::table('users')->where('email',$request->email)->first();

        if ($user) {
            toastr()->warning('user already exists!');
            return redirect()->back();

          
         }else{
          
    ///////////alert
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)

    ]);
    Auth::login($user);
    //////////////
    toastr()->success('Welcome !');

    return redirect()->back();
         }

          
        
    }

    ////////////////////////////////////////////logout
    public function logout()
    {
        auth()->logout();
        Session::flush();
        toastr()->warning('log out successfully');

        return redirect('/home');
    }
}
