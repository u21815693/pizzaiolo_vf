<?php

namespace App\Http\Controllers;

use App\Commande;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    protected $redirectTo = '/';

    public function showLoginForm()
    {
        return view('login_user');
    }

    public function authenticate(Request $request)
    {
        $this->validate($request,
            [
                'login' => 'required|string',
                'password' => 'required'

            ]
        );
        if (Auth::attempt(['login' => $request['login'], 'password' => $request['password']])) {
            if (Auth::attempt(['password' => $request['password']])) {
                return back()->withInput();
            } else {
                return redirect()->intended('/home');
            }
        } else {
            return back()->withInput();
        }
    }

    public function register_user(Request $request)
    {
        $this->validate($request,
            [
                'login' => 'required|string|unique:users',
                'nom' => 'required|string',
                'prenom' => 'required|string',

                'password' => ['required', 'string', 'min:8', 'confirmed'],

            ]
        );
        $user = new User;
        $user->login = $request->input('login');
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->password = Hash::make($request->input('password'));
        $user->type = 'user';
        $user->save();
        $this->guard()->login($user);
        return redirect('/home');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
