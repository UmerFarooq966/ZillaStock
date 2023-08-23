<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',

        ]);

        /*
         *
         *  $input = $request->all();

        $input = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',

        ]);

        $email = $input['email'];
        $password = $input['password'];

        if(auth()->attempt($email, $password))
        {
         */

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {

            if (auth()->user()->role == 'admin')
            {
                return redirect()->route('Admin.home');
            }
            else if (auth()->user()->role == 'team')
            {
                return redirect()->route('team.Teamhome');
            }
            else
            {
                return redirect()->route('home');
            }
        }
        else
        {
            return redirect()
                ->route('login')
                ->with('error','Incorrect email or password!.');
        }
    }
}
