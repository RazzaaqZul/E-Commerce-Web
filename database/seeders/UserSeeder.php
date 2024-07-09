<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() : void
    {
        $user = new User();
        $user->id_user = '1';
        $user->email = 'test@gmail.com';
        $user->username = 'test123';
        $user->password = 'rahasia';
        $user->fullname = 'ahmad test';
        $user->gender = 'male';
        $user->remember_token = 'token123';
        $user->address = 'jl. Cendana 2';
        $user->save();
    }
}
