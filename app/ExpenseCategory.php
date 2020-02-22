<?php

namespace ExpenseManager;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $fillable = ['display_name', 'description'];
}
