<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // /*
    // |--------------------------------------------------------------------------
    // | Login Controller
    // |--------------------------------------------------------------------------
    // |
    // | This controller handles authenticating users for the application and
    // | redirecting them to your home screen. The controller uses a trait
    // | to conveniently provide its functionality to your applications.
    // |
    // */

    // use AuthenticatesUsers;

    // /**
    //  * Where to redirect users after login.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = RouteServiceProvider::HOME;

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
    public function showLoginForm()
    {
        $user = auth()->user();
        if ($user != null) {
            if ($user->role_id == 1) {
                return redirect()->route('admin.sipa.home')->with('success', 'Selamat Datang Administrator');
            } else if ($user->role_id == 2) {
                return redirect()->route('user.sipa.home')->with('success', 'Selamat Datang ' . $user->first_name . ' ' . $user->last_name);
            } else {
                return redirect()->route('welcome');
            }
        } else {
            return view('auth.login');
        }
    }
    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            $user = auth()->user();

            if ($user->status != 'Active') {
                Auth::logout();
                return redirect()->route('login')
                    ->with('error', 'User anda tidak aktif, Silakan hubungi Administrator!');
            }

            if ($user->role_id == 1) {
                return redirect()->route('admin.sipa.home')->with('success', 'Selamat Datang Administrator');
            } else if ($user->role_id == 2) {
                return redirect()->route('user.sipa.home')->with('success', 'Selamat Datang ' . $user->first_name . ' ' . $user->last_name);
            } else {
                return redirect()->route('welcome');
            }
        } else {
            return redirect()->route('login')
                ->with('error', 'Email-Address And Password Are Wrong.');
        }
    }




    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
