<?php

namespace ExpenseManager\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    
	public function index()
	{
		if(auth()->check()){
			return redirect()->route('dashboard');
		}
		
		return view('index');
	}

}
