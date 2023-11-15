<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(){
        User::create([
            'name'=>'Super Admin',
            'email'=>'admin@admin.com',
            'role'=>'Super Admin',
            'password'=>bcrypt('admin12300'),
            ]);
    }
}
