<?php

use ExpenseManager\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    
    public function run()
    {
        $role_admin = new Role();
        $role_admin->display_name = 'Administrator';
        $role_admin->description = 'super user';
        $role_admin->save();

        $role_user = new Role();
        $role_user->display_name = 'User';
        $role_user->description = 'can add expenses';
        $role_user->save();
    }
}
