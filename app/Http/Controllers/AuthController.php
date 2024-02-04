<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        if (!Auth::attempt($request->only(['login', 'password']))) {
            return redirect()->back()->withErrors(['message' => 'Invalid login or password.']);
        }

        return redirect()->route('home');
    }

    public function getRegister()
    {
        return view('register');
    }

    public function postRegister(Request $request)
    {
        $v = Validator::make($request->all(), [
            'login' => 'required|string|regex:/[a-zA-Z]/u',
            'password' => 'required|string|confirmed'
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }

        $user = User::query()->create(
            $request
                ->merge(['password' => Hash::make($request->password)])
                ->only(['login', 'password'])
        );

        Auth::login($user);

        return redirect()->route('home');
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect()->back();
    }
}
