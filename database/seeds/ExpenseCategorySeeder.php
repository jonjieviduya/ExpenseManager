<?php

use Illuminate\Database\Seeder;
use ExpenseManager\ExpenseCategory;

class ExpenseCategorySeeder extends Seeder
{
    
    public function run()
    {
        $travel_category = new ExpenseCategory();
        $travel_category->display_name = 'Travel';
        $travel_category->description = 'daily commute';
        $travel_category->save();

        $entertainment_category = new ExpenseCategory();
        $entertainment_category->display_name = 'Entertainment';
        $entertainment_category->description = 'movies etc.';
        $entertainment_category->save();
    }
}
