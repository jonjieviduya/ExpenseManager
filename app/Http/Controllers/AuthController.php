<?php

namespace ExpenseManager\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

	public function postLogin()
	{
		if(auth()->attempt(['email' => request('email'), 'password' => request('password')]))
		{
		    return redirect()->route('dashboard');
		}

		return redirect('/')
			->withInput()
			->with('login-error', 'Sorry, login failed. Please check your credentials and try again.');
	}

	public function logout()
	{
		auth()->logout();
		return redirect('/');
	}

}
