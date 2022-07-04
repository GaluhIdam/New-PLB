<?php

namespace Database\Seeders;

use App\Models\DashboardEmpat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DashboardEmpatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DashboardEmpat::create([
            'status_bc_16' => 'BC 16 < 3 Tahun',
            'jumlah_bc_16' => 8778,
        ]);
        DashboardEmpat::create([
            'status_bc_16' => 'BC 16> 3 Tahun',
            'jumlah_bc_16' => 334,
        ]);
    }
}
