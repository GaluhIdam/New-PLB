<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
                    'name' => 'Admin PLB',
                    'username' => 'adminPLB',
                    'email' => 'admin@gmf-aeroasia.co.id',
                    'password' => Hash::make('@eroas1a'),
                    'role' => 'admin',
                    'created_at' => Carbon::now(),
                ],
                [
                    'name' => 'Planner',
                    'username' => 'planner',
                    'email' => 'planner@gmf-aeroasia.co.id',
                    'password' => Hash::make('password'),
                    'role' => 'planner',
                    'created_at' => Carbon::now(),
                ],
                [
                    'name' => 'User',
                    'username' => 'user',
                    'email' => 'user@gmf-aeroasia.co.id',
                    'password' => Hash::make('plbc9k'),
                    'role' => 'user',
                    'created_at' => Carbon::now(),
                ],
                [
                    'name' => 'Admin JTI',
                    'username' => 'adminJTI',
                    'email' => 'info@opencloud.id',
                    'password' => Hash::make('p@ssw0rd'),
                    'role' => 'admin',
                    'created_at' => Carbon::now(),
                ]
            ]
        );
        User::factory()->count(5)->create();
    }
}