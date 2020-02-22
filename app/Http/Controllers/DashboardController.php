<?php

namespace ExpenseManager\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use ExpenseManager\ExpenseCategory;

class DashboardController extends Controller
{
    
	public function index()
	{
		$expenses_raw = DB::table('expenses')
		->where('user_id', auth()->user()->id)
		->select(DB::raw('expense_category_id as category_id'), DB::raw('sum(amount) as total'))
	    ->groupBy(DB::raw('expense_category_id') )
	    ->get();

	    $expenses = [];
	    $expenses_amount = [];
	    $expenses_category = [];

		foreach($expenses_raw as $expense_raw){
			$expenses[] = [
				'category' => ExpenseCategory::find($expense_raw->category_id)->display_name,
				'amount' => $expense_raw->total
			];

			$expenses_amount[] = $expense_raw->total;
			$expenses_category[] = ExpenseCategory::find($expense_raw->category_id)->display_name;
		}

		$expenses_amount = json_encode($expenses_amount);
		$expenses_category = json_encode($expenses_category);


		return view('dashboard.index', compact('expenses', 'expenses_amount', 'expenses_category'));
	}

}
