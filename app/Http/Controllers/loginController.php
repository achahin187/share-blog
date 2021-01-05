<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;

class loginController extends Controller
{

    public function __construct()
    {
$this->middleware('guest')->except('logout');

    }
    

    public function login(Request $request){

       ///validate
  $rules=[
    'email' => 'required|email',
    'password' => 'required'
];
   $request->validate($rules);

   ///check user exists
   $data=request([
         'email','password'
   ]);
   if(!auth()->attempt($data)){
    toastr()->error('user is not exists!');

       return redirect()->back();
   }
   toastr()->success('Welcome !');
   toastr()->success('login successfully!');

   return redirect()->back();

    }
}
