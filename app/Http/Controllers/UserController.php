<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class UserController extends Controller
{
    public function index(Request $request){
        $username = $request->username;
        $password = $request->password;
        $user = Users::where('username','=',$username)->first();
        $pass = Users::where('password','=',$password)->first();
        if($user && $user->password == $password){
            $request->session()->put('user', $user);
            if($user->role == 'admin')
                return redirect()->to('/admin');
            else if($user->role == 'driver')
                return redirect()->to('/drivers');
            else if($user->role == 'supervisor')
                return redirect()->to('/supervisors');
        }
        return redirect()->back();
    }

    public function logout(Request $request){
        $user = $request->session()->get('user');
        $request->session()->forget('user');
        return redirect()->to('/');
    }
    public function profile(Request $request){
        return view('layout.profile');
    }
    public function edit_profile(Request $request){
        $user = Users::where('username','=',$request->session()->get('user')->username)->first();
        $user->fullname = $request->name;
        $user->password = $request->password;
        $user->save();
        $request->session()->put('user', $user);
        return json_encode("201");
    }
}
