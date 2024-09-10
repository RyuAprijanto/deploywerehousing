<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            [
                'username' => 'Test Seller',
                'email' => 'test@gmail.com',
                'role_id' => 1,
                'password' => Hash::make('abcde')
            ],
            [
                'username' => 'Test Supplier',
                'email' => 'test2@gmail.com',
                'role_id' => 2,
                'password' => Hash::make('abcde')
            ]
            ]);


    }
}
