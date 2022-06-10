<?php

namespace Database\Seeders;

use App\Models\Outbound;
use Illuminate\Database\Seeder;

class OutboundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Outbound::create([
            'part_number' => 'AH2134',
            'condition' => 'New',
            'description' => 'description',
            'quantity' => '1',
            'unit_code' => 'CD001',
            'register_ac' => 'BA 777',
            'customer' => 'customer',
            'date_install' => '06/06/2022',
            'date_ac_in' => '04/06/2022',
            'date_ac_out' => '07/06/2022',
            'type_bc_out' => 'BC',
            'no_aju' => '431',
            'no_register' => '765',
            'cif_idr' => '987',
            'date_bc_out' => '09/06/2022',
            'bm_paid' => '20000',
            'ppn_paid' => '50000',
            'pph_paid' => '30000'
        ]);

        Outbound::create([
            'part_number' => 'BK8735',
            'condition' => 'New',
            'description' => 'description',
            'quantity' => '1',
            'unit_code' => 'AT054',
            'register_ac' => 'BJ 875',
            'customer' => 'customer',
            'date_install' => '03/06/2022',
            'date_ac_in' => '01/06/2022',
            'date_ac_out' => '02/06/2022',
            'type_bc_out' => 'BC',
            'no_aju' => '332',
            'no_register' => '986',
            'cif_idr' => '432',
            'date_bc_out' => '08/06/2022',
            'bm_paid' => '30000',
            'ppn_paid' => '40000',
            'pph_paid' => '20000'
        ]);

        Outbound::create([
            'part_number' => 'KM8392',
            'condition' => 'New',
            'description' => 'description',
            'quantity' => '1',
            'unit_code' => 'BB879',
            'register_ac' => 'TB 972',
            'customer' => 'customer',
            'date_install' => '05/06/2022',
            'date_ac_in' => '06/06/2022',
            'date_ac_out' => '08/06/2022',
            'type_bc_out' => 'BC',
            'no_aju' => '123',
            'no_register' => '987',
            'cif_idr' => '766',
            'date_bc_out' => '10/06/2022',
            'bm_paid' => '20000',
            'ppn_paid' => '50000',
            'pph_paid' => '20000'
        ]);
    }
}
