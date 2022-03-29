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
    public function run()
    {
        for($i = 0; $i<2; $i++){
            User::create([
                'firstname' => 'user'.$i + 1,
                'lastname'  => 'user'.$i + 1,
                'username' => 'user'.$i + 1,
                'email'     => 'user'. $i + 1 .'@gmail.com',
                'address' => 'useraddress',
                'city' => 'usercity',
                'password' => Hash::make('user'.$i + 1),
                'remember_token' => null,
            ]);
        }
        for($i = 0; $i<2; $i++){
            User::create([
                'is_admin' => true,
                'firstname' => 'admin'.$i + 1,
                'lastname'  => 'admin'.$i + 1,
                'username' => 'admin'.$i + 1,
                'email'     => 'admin'.$i + 1 .'@gmail.com',
                'address' => 'adminaddress',
                'city' => 'admincity',
                'password' => Hash::make('admin'.$i + 1,),
                'remember_token' => null,
                'balance' => 0
            ]);
        }
    }
}
