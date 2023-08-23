<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AUserController extends Controller
{
    public function index()
    {
        // $users = User::all();
        //  $users = User::all()->where('role', '1')->first()->User()->get();
        $users = User::where('role', '0')->get();

        return view('Admin/User/index')->with('users', $users);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'int', 'max:1'],
        ]);
        $request=([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => $request['role'],

        ]);

        $input = $request;
        $users = User::create($input);

        return redirect()->route('Userr.index',$users->id)
            ->with('success','Type created successfully.');
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('Userr.index')
            ->with('success', 'Type deleted successfully');
    }
}
