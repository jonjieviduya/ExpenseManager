<?php

namespace ExpenseManager;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['display_name', 'description'];
}
