<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserDashController extends Controller
{

    /* public function index()
     {
        return view('index',["msg"=>"Hello! I am user"]);
     }
    */
    public function UserDashboard()
    {
        if (auth()->user()->role == 'user') {

            return view('Buyer.B-dashboard');
        } elseif (auth()->user()->role == 'admin') {
            return redirect()->route('admin.home');
        } elseif (auth()->user()->role == 'team') {
            return redirect()->route('team.home');
        } else {
            return redirect()->route('home');
        }


    }

    public function UserProfile()
    {
        if (auth()->user()->role == 'user') {

            return view('Buyer.Profile');
        } elseif (auth()->user()->role == 'admin') {
            return redirect()->route('admin.home');
        } elseif (auth()->user()->role == 'team') {
            return redirect()->route('team.home');
        } else {
            return redirect()->route('home');
        }


    }

}
