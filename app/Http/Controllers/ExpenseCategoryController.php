<?php

namespace ExpenseManager\Http\Controllers;

use Illuminate\Http\Request;
use ExpenseManager\ExpenseCategory;

class ExpenseCategoryController extends Controller
{

	public function index()
	{
		$expense_categories = ExpenseCategory::all()->toJSON();

		return view('dashboard.expense-category.index', compact('expense_categories'));
	}

	public function postAddExpenseCategory()
	{
		$this->validate(request(), [
			'display_name' => 'required|unique:expense_categories,display_name',
			'description' => 'required'
		]);
		
		$expense_category = ExpenseCategory::create([
			'display_name' => request('display_name'),
			'description' => request('description')
		]);

		return $expense_category->toJSON();
	}

	public function postUpdateExpenseCategory()
	{
		$expense_category = ExpenseCategory::findOrFail(request('id'));

		$this->validate(request(), [
			'display_name' => 'required',
			'description' => 'required'
		]);

		$expense_category->update([
			'display_name' => request('display_name'),
			'description' => request('description')
		]);

		return $expense_category->toJSON();
	}

	public function getDeleteExpenseCategory($id)
	{
		$expense_category = ExpenseCategory::findOrFail($id);

		$expense_category->delete();

		return redirect()->route('expense-categories');
	}

}
