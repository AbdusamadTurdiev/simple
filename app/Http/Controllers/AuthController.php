<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function postSignUp(Request $request)
    {
    	$this->validate($request, [
    		'email' => 'required|unique:users|email|max:255',
    		'username' => 'required|unique:users|alpha_dash|max:20',
    		'password' => 'required|min:6',
    	]);

    	User::create([
    		'email' => $request->input('email'),
    		'username' => $request->input('username'),
    		'password' => bcrypt($request->input('password')),
    	]);

    	return redirect()->back()->with('info', 'Вы успешно зарегистрировались.');
    }

    public function postSignIn(Request $request)
    {
    	$this->validate($request, [
    		'email' => 'required',
    		'password' => 'required',
    	]);

    	if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
    		return redirect()->back()->with('info', 'Неверные данные.');
    	}

    	return redirect()->route('home');
    }

    public function getSignOut()
    {
    	Auth::logout();

    	return redirect()->route('home');
    }
}
