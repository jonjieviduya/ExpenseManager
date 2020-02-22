<?php

namespace ExpenseManager\Http\Controllers;

use DB;
use ExpenseManager\User;
use ExpenseManager\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
	public function index()
	{
		$users_raw = User::all();
		$users = [];

		foreach($users_raw as $user_raw)
		{
			$users[] = [
				'id' => $user_raw->id,
				'name' => $user_raw->name,
				'email' => $user_raw->email,
				'role' => $user_raw->getRole()->display_name,
				'created_at' => $user_raw->created_at
			];
		}

		$users = json_encode($users);

		$roles = Role::all()->pluck('display_name')->toJSON();

		return view('dashboard.users.index', compact('users', 'roles'));
	}

	public function postAddUser()
	{
		$this->validate(request(), [
			'name' => 'required',
			'email' => 'required|email|unique:users,email'
		]);
		
		$user = User::create([
			'name' => request('name'),
			'email' => request('email'),
			'password' => request('email')
		]);

		$role = Role::where('display_name', request('role'))->first();

		$user->roles()->attach($role);

		return json_encode([
			'id' => $user->id,
			'name' => request('name'),
			'email' => request('email'),
			'role' => request('role'),
			'created_at' => $user->created_at
		]);
	}

	public function postUpdateUser()
	{
		$user = User::findOrFail(request('id'));

		$new_role = Role::where('display_name', request('role'))->first();

		// validate user data
		$this->validate(request(), [
			'name' => 'required',
			'email' => 'required|email|unique:users,email,'.$user->id
		]);

		// Update user data
		$user->update([
			'name' => request('name'),
			'email' => request('email')
		]);

		// Delete all user's role
		$role_connection = DB::table('role_user')->where('user_id', $user->id)->delete();

		// Attach new role to the user
		$user->roles()->attach($new_role);

		return $user->toJSON();
	}

	public function getDeleteUser($id)
	{
		$user = User::findOrFail($id);

		$user->delete();

		return redirect()->route('users');
	}

}
