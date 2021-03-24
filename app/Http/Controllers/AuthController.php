<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\User;
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
                'mdp' => 'required'

            ]
        );
        $user = User::where('login', $request['login'])->first();
        $user = User::where('login', $request['login'])->first();
        if ($user) {
            if (password_verify($request['mdp'], $user->mdp)) {
                $this->guard()->login($user);
                return redirect('/home');
            } else {
                return back()->withInput();
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

                'mdp' => ['required', 'string']
            ]
        );
        $user = new User;
        $user->login = $request->input('login');
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->mdp = Hash::make($request->input('mdp'));
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
