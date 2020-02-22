<?php

Route::get('/', 'PageController@index')->middleware('guest');

Route::post('login', 'AuthController@postLogin')->name('login');

Route::get('logout', 'AuthController@logout')->name('logout');

Route::get('dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');

Route::get('change-password', 'AccountSettingsController@getChangePassword')
	->name('changepassword')
	->middleware('auth');

Route::post('change-password', 'AccountSettingsController@postChangePassword')
	->middleware('auth');

Route::group([
	'middleware' => ['auth', 'admin']
], function(){

	Route::get('roles', 'RoleController@index')->name('roles');

	Route::post('add-role', 'RoleController@postAddRole')->name('role.add');

	Route::post('update-role', 'RoleController@postUpdateRole')->name('role.update');

	Route::get('delete-role/{id}', 'RoleController@getDeleteRole')->name('role.delete');

});


Route::group([
	'middleware' => ['auth', 'admin']
], function(){

	Route::get('users', 'UserController@index')->name('users');

	Route::post('add-user', 'UserController@postAddUser')->name('user.add');

	Route::post('update-user', 'UserController@postUpdateUser')->name('user.update');

	Route::get('delete-user/{id}', 'UserController@getDeleteUser')->name('user.delete');

});


Route::group([
	'middleware' => ['auth', 'admin']
], function(){

	Route::get('expense-categories', 'ExpenseCategoryController@index')->name('expense-categories');

	Route::post('add-expense-category', 'ExpenseCategoryController@postAddExpenseCategory')->name('expense-category.add');

	Route::post('update-expense-category', 'ExpenseCategoryController@postUpdateExpenseCategory')->name('expense-category.update');

	Route::get('delete-expense-category/{id}', 'ExpenseCategoryController@getDeleteExpenseCategory')->name('expense-category.delete');

});


Route::group([
	'middleware' => ['auth']
], function(){

	Route::get('expenses', 'ExpenseController@index')->name('expenses');

	Route::post('add-expense', 'ExpenseController@postAddExpense')->name('expense.add');

	Route::post('update-expense', 'ExpenseController@postUpdateExpense')->name('expense.update');


	Route::get('delete-expense/{id}', 'ExpenseController@getDeleteExpense')->name('expense.delete');
});