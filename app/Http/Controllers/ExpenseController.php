<?php

namespace ExpenseManager\Http\Controllers;

use ExpenseManager\Expense;
use Illuminate\Http\Request;
use ExpenseManager\ExpenseCategory;

class ExpenseController extends Controller
{
    
	public function index()
	{
		$expense_categories = ExpenseCategory::all()->pluck('display_name')->toJSON();
		$expenses_raw = auth()->user()->expenses;

		$expenses = [];

		foreach($expenses_raw as $expense_raw)
		{
			$expenses[] = [
				'id' => $expense_raw->id,
				'expense_category' => $expense_raw->category->display_name,
				'amount' => $expense_raw->amount,
				'entry_date' => date_format(new \DateTime($expense_raw->entry_date), 'm/d/Y'),
				'created_at' => $expense_raw->created_at
			];
		}

		$expenses = json_encode($expenses);

		return view('dashboard.expenses.index', compact('expenses', 'expense_categories'));
	}

	public function postAddExpense()
	{

		$this->validate(request(), [
			'expense_category' => 'required',
			'amount' => 'required|numeric',
			'entry_date' => 'required'
		]);
		
		$category = ExpenseCategory::where('display_name', request('expense_category'))->first();

		$expense = Expense::create([
			'expense_category_id' => $category->id,
			'user_id' => auth()->user()->id,
			'amount' => request('amount'),
			'entry_date' => date_format(new \DateTime(request('entry_date')), 'Y-m-d')
		]);

		return json_encode([
			'id' => auth()->user()->id,
			'expense_category' => request('expense_category'),
			'amount' => request('amount'),
			'entry_date' => request('entry_date'),
			'created_at' => $expense->created_at
		]);
	}

	public function postUpdateExpense()
	{
		$expense = Expense::findOrFail(request('id'));

		$expense_category = ExpenseCategory::where('display_name', request('expense_category'))->first();

		// validate user data
		$this->validate(request(), [
			'expense_category' => 'required',
			'amount' => 'required|numeric',
			'entry_date' => 'required'
		]);

		// Update user data
		$expense->update([
			'expense_category_id' => $expense_category->id,
			'amount' => request('amount'),
			'entry_date' => date_format(new \DateTime(request('entry_date')), 'Y-m-d')
		]);

		return $expense->toJSON();
	}

	public function getDeleteExpense($id)
	{
		$user = Expense::findOrFail($id);

		$user->delete();

		return redirect()->route('expenses');
	}

}
