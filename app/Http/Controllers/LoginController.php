<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserAccount;
use Session;

class LoginController extends Controller
{
    //
    public function index(){
      return view('login');
    }

    public function checkAccount(Request $request){
      $rules = ['inputUsername' => 'required',
                'inputPassword' => 'required'];

      $this->validate($request, $rules);
      $user = UserAccount::find($request->inputUsername);

      if($user == null){
        return view('login')->with('alert-danger', 'User Name not found!');
      }
      if($user->strStafPassword == $request->inputPassword){
        session(['user_id' => $user->strStafId, 'user_name' => $user->strStafFirst .' '. $user->strStafLast]);
        return view('maintenance/customer');
      }
      else{
        return view('login')->with('alert-danger', 'Username/Password does not match!');
      }
    }

    public function logoutAccount(){
      Session::flush();
      return view('login');
    }
}
