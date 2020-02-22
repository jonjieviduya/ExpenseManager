<?php

namespace ExpenseManager\Http\Controllers;

use ExpenseManager\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    
	public function index()
	{
		$roles = Role::all()->toJSON();

		return view('dashboard.users.roles.index', compact('roles'));
	}

	public function postAddRole()
	{
		$this->validate(request(), [
			'display_name' => 'required|unique:roles,display_name',
			'description' => 'required'
		]);
		
		$role = Role::create([
			'display_name' => request('display_name'),
			'description' => request('description')
		]);

		return $role->toJSON();
	}

	public function postUpdateRole()
	{
		$role = Role::findOrFail(request('id'));

		$this->validate(request(), [
			'display_name' => 'required',
			'description' => 'required'
		]);

		$role->update([
			'display_name' => request('display_name'),
			'description' => request('description')
		]);

		return $role->toJSON();
	}

	public function getDeleteRole($id)
	{
		$role = Role::findOrFail($id);

		if($role->display_name == 'Administrator'){
			return redirect()->back()->with('script-message', 'Sorry,  you cannot delete the that role.');
		}

		$role->delete();

		return redirect()->route('roles');
	}

}
