<?php

namespace Database\Seeders;

use App\Models\DashboardSatu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DashboardSatuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DashboardSatu::create([
            'status_bc_28' => 'Outbound pada Pesawat di Area PLB GMF',
            'item' => '587',
        ]);
        DashboardSatu::create([
            'status_bc_28' => 'Outbound <= 14 Hari sejak Pesawat Keluar',
            'item' => '778',
        ]);
        DashboardSatu::create([
            'status_bc_28' => 'Outbound > 14 Hari sejak Pesawat Keluar',
            'item' => '100',
        ]);
        DashboardSatu::create([
            'status_bc_28' => 'Sudah Dibuat BC 28',
            'item' => '6687',
        ]);
    }
}
