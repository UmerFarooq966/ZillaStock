<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Adminhome()
    {

        if (auth()->user()->role == 'user')
        {

            return view('Buyer.Profile');
        }
        elseif (auth()->user()->role == 'admin')
        {
            return view('Admin.A-dashboard');
        }
        elseif (auth()->user()->role == 'editor')
        {
            return redirect()->route('editor.home');
        }
        else
        {
            return redirect()->route('home');
        }

    }






}
