<?php

namespace Database\Seeders;

use App\Models\DashboardDua;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DashboardDuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DashboardDua::create([
            'customer' => 'Garuda',
            'total' => 10,
        ]);
        DashboardDua::create([
            'customer' => 'Citilink',
            'total' => 4,
        ]);
        DashboardDua::create([
            'customer' => 'Indigo',
            'total' => 2,
        ]);
        DashboardDua::create([
            'customer' => 'KLM',
            'total' => 2,
        ]);
    }
}
