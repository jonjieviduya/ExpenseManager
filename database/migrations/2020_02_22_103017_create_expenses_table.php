<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    public function up()
        {
            Schema::create('expenses', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('expense_category_id');
                $table->integer('user_id');
                $table->double('amount');
                $table->date('entry_date');
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('expenses');
        }
}
