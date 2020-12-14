<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        User::Create([
            'name' => 'Super Admin',
            'email' => 'super@mail.com',
            'phone_number' => '01620327185',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'type' => 'super',
        ]);
    }
}
