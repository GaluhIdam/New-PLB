<?php

namespace Database\Seeders;

use App\Models\DashboardLima;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DashboardLimaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DashboardLima::create([
            'plant' => 'BPN',
            'quantity' => 305,
        ]);
        DashboardLima::create([
            'plant' => 'CGK',
            'quantity' => 1054,
        ]);
        DashboardLima::create([
            'plant' => 'DPS',
            'quantity' => 788,
        ]);
        DashboardLima::create([
            'plant' => 'KNO',
            'quantity' => 844,
        ]);
        DashboardLima::create([
            'plant' => 'SUB',
            'quantity' => 945,
        ]);
        DashboardLima::create([
            'plant' => 'UPG',
            'quantity' => 658,
        ]);
    }
}
