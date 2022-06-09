<?php

namespace Database\Seeders;

use App\Models\Outbound1;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Outbound1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Outbound1::create([
            'part_number' => 'tes',
            'description' => 'tes',
            'quantity' => 'tes',
            'unit_code' => 'tes',
            'register' => 'tes',
            'customer' => 'tes',
            'date_install' => 'tes',
            'date_ac_in' => 'tes'
        ]);

        Outbound1::create([
            'part_number' => 'cek',
            'description' => 'cek',
            'quantity' => 'cek',
            'unit_code' => 'cek',
            'register' => 'cek',
            'customer' => 'cek',
            'date_install' => 'cek',
            'date_ac_in' => 'cek'
        ]);
    }
}
