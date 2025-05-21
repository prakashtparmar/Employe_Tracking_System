<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('password');
        $admin = new Admin;
        $admin->name = 'Prakash Parmar';
        $admin->role = 'admin';
        $admin->mobile = '9999999999';
        $admin->email = 'prakashtparmar@gmail.com';
        $admin->password = $password;
        $admin->status = 1;
        $admin->save(); 

        $admin = new Admin;
        $admin->name = 'Mittal Makwana';
        $admin->role = 'subadmin';
        $admin->mobile = '9999999999';
        $admin->email = 'mittal@gmail.com';
        $admin->password = $password;
        $admin->status = 1;
        $admin->save();

        $admin = new Admin;
        $admin->name = 'Shital Parmar';
        $admin->role = 'subadmin';
        $admin->mobile = '9999999999';
        $admin->email = 'shital@gmail.com';
        $admin->password = $password;
        $admin->status = 1;
        $admin->save();
    }

    
}
