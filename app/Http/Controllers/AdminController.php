<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() {
//        if(auth()->check()) {
//            return redirect()->to('home');
//        }
        return view('login');
    }

    public function loginHandling(Request $request) {
        if(auth() -> attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $user = User::where('email', $request->email)->first();
            $roles = Role::all();
            $roleOfUser = $user->roles;
            foreach ($roles as $role) {
                if($roleOfUser->contains('id' , 2)) {
                    if (session()->has('url.intended')) {
                        return redirect()->intended('/');
                    }
                    return redirect()->to('/');
                    break;
                } else {
                    return view('admin.home');
                    break;
                }
            }
        }
        return redirect()->back()->with('error', 'Email password invalid!');
    }

    public function logoutHandling()
    {
        session()->forget('cart');
        session()->forget('url.intended');
        Auth::logout();
        return redirect()->to('/');
    }

    public function home() {
        return view('admin.home');
    }
}
