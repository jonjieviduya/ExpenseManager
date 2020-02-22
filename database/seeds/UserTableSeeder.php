<?php

use ExpenseManager\User;
use ExpenseManager\Role;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    
    public function run()
    {
        $admin_role = Role::where('display_name', 'Administrator')->first();
        $user_role = Role::where('display_name', 'User')->first();

        $user1 = new User();
        $user1->name = 'Admin Lastname';
        $user1->email = 'admin@arb.com';
        $user1->password = bcrypt('admin');
        $user1->save();
        $user1->roles()->attach($admin_role);

        $user2 = new User();
        $user2->name = 'John Doe';
        $user2->email = 'johndoe@gmail.com';
        $user2->password = bcrypt('john');
        $user2->save();
        $user2->roles()->attach($user_role);
    }
}
