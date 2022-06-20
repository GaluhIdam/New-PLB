<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert(
            [
                [
                    'name' => 'Admin',
                    'username' => 'admin',
                    'email' => 'admin@opencloud.id',
                    'password' => Hash::make('password'),
                    'role' => 'admin',
                    'created_at' => Carbon::now(),
                ],
                [
                    'name' => 'Planner',
                    'username' => 'planner',
                    'email' => 'planner@opencloud.id',
                    'password' => Hash::make('password'),
                    'role' => 'planner',
                    'created_at' => Carbon::now(),
                ],
                [
                    'name' => 'User',
                    'username' => 'user',
                    'email' => 'user@opencloud.id',
                    'password' => Hash::make('password'),
                    'role' => 'user',
                    'created_at' => Carbon::now(),
                ]
            ]
        );
<<<<<<< HEAD
=======

>>>>>>> dev
        User::factory()->count(50)->create();
    }
}
