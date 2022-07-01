<?php

namespace Database\Seeders;

use App\Models\DashboardTiga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DashboardTigaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DashboardTiga::create([
            'bulan' => 'Januari',
            'total_bc28' => 45,
            'payment_value_bc28' => 2365478450,
        ]);
        DashboardTiga::create([
            'bulan' => 'Februari',
            'total_bc28' => 55,
            'payment_value_bc28' => 3365542800,
        ]);
        DashboardTiga::create([
            'bulan' => 'Maret',
            'total_bc28' => 24,
            'payment_value_bc28' => 1223545800,
        ]);
        DashboardTiga::create([
            'bulan' => 'April',
            'total_bc28' => 48,
            'payment_value_bc28' => 2789546400,
        ]);
    }
}
