<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            DashboardSatuSeeder::class,
            DashboardDuaSeeder::class,
            DashboardTigaSeeder::class,
            DashboardEmpatSeeder::class,
            DashboardLimaSeeder::class,
        ]);
    }
}