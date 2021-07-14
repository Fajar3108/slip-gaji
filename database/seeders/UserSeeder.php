<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => 1,
            'name' => 'Admin',
            'email' => 'admin@intek.co.id',
            'nik' => '123admin',
            'email_verified_at' => now(),
            'password' => bcrypt('t3rk3n4l1234'),
            'remember_token' => '',
        ]);
    }
}
