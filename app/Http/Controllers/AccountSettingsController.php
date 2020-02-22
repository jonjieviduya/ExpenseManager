<?php

namespace ExpenseManager\Http\Controllers;

use Illuminate\Http\Request;

class AccountSettingsController extends Controller
{

	public function getChangePassword()
	{
		return view('dashboard.users.account-settings.changepassword');
	}

	public function postChangePassword()
	{
		if(!password_verify(request('current_password'), auth()->user()->password))
		{
			return redirect()
				->back()
				->with('password-incorrect', 'Your current password is incorrect.');
		}

		$this->validate(request(), [
			'current_password' => 'required',
			'new_password' => 'required',
			'retype_password' => 'required|same:new_password'
		]);

		auth()->user()->update(['password' => bcrypt(request('new_password'))]);

		return redirect()->route('changepassword')->with('script-message', 'Password has been changed successfully!');
	}

}
