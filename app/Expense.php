<?php

namespace ExpenseManager;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['expense_category_id', 'user_id', 'amount', 'entry_date'];


    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function category()
    {
    	return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }

}
