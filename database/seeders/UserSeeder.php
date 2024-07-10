<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        $user->password = Hash::make('rahasia');
        $user->fullname = 'ahmad test';
        $user->gender = 'male';
        $user->remember_token = '';
        $user->address = 'jl. Cendana 2';
        $user->save();
    }
}
