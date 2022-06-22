<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Models\MovementAllotment;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MovementAllotmentSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MovementAllotment::create([
            'osa' => 'KNO',
            'first_balance' => '82',
            'kno_plus' => Null,
            'kno_min' => Null,
            'upg_plus' => 2,
            'upg_min' => 4,
            'sub_plus' => 0,
            'sub_min' => 0,
            'bpn_plus' => 5,
            'bpn_min' => 1,
            'dps_plus' => 9,
            'dps_min' => 0,
            'cgk_plus' => 0,
            'cgk_min' => 0,
            'consumption_install' => 30,
            'return_to_plb_gmf' => 7,
            'last_balance' => 56,
            'date' => '2022-06-22',
        ]);
        MovementAllotment::create([
            'osa' => 'UPG',
            'first_balance' => '82',
            'kno_plus' => Null,
            'kno_min' => Null,
            'upg_plus' => 2,
            'upg_min' => 4,
            'sub_plus' => 0,
            'sub_min' => 0,
            'bpn_plus' => 5,
            'bpn_min' => 1,
            'dps_plus' => 9,
            'dps_min' => 0,
            'cgk_plus' => 0,
            'cgk_min' => 0,
            'consumption_install' => 30,
            'return_to_plb_gmf' => 7,
            'last_balance' => 56,
            'date' => '2022-06-23',
        ]);
        MovementAllotment::create([
            'osa' => 'SUB',
            'first_balance' => '82',
            'kno_plus' => Null,
            'kno_min' => Null,
            'upg_plus' => 2,
            'upg_min' => 4,
            'sub_plus' => 0,
            'sub_min' => 0,
            'bpn_plus' => 5,
            'bpn_min' => 1,
            'dps_plus' => 9,
            'dps_min' => 0,
            'cgk_plus' => 0,
            'cgk_min' => 0,
            'consumption_install' => 30,
            'return_to_plb_gmf' => 7,
            'last_balance' => 56,
            'date' => '2022-06-23',
        ]);
        MovementAllotment::create([
            'osa' => 'SUB',
            'first_balance' => '82',
            'kno_plus' => Null,
            'kno_min' => Null,
            'upg_plus' => 2,
            'upg_min' => 4,
            'sub_plus' => 0,
            'sub_min' => 0,
            'bpn_plus' => 5,
            'bpn_min' => 1,
            'dps_plus' => 9,
            'dps_min' => 0,
            'cgk_plus' => 0,
            'cgk_min' => 0,
            'consumption_install' => 30,
            'return_to_plb_gmf' => 7,
            'last_balance' => 56,
            'date' => '2022-06-24',
        ]);
        MovementAllotment::create([
            'osa' => 'BPN',
            'first_balance' => '82',
            'kno_plus' => Null,
            'kno_min' => Null,
            'upg_plus' => 2,
            'upg_min' => 4,
            'sub_plus' => 0,
            'sub_min' => 0,
            'bpn_plus' => 5,
            'bpn_min' => 1,
            'dps_plus' => 9,
            'dps_min' => 0,
            'cgk_plus' => 0,
            'cgk_min' => 0,
            'consumption_install' => 30,
            'return_to_plb_gmf' => 7,
            'last_balance' => 56,
            'date' => '2022-06-25',
        ]);
        MovementAllotment::create([
            'osa' => 'DPS',
            'first_balance' => '82',
            'kno_plus' => Null,
            'kno_min' => Null,
            'upg_plus' => 2,
            'upg_min' => 4,
            'sub_plus' => 0,
            'sub_min' => 0,
            'bpn_plus' => 5,
            'bpn_min' => 1,
            'dps_plus' => 9,
            'dps_min' => 0,
            'cgk_plus' => 0,
            'cgk_min' => 0,
            'consumption_install' => 30,
            'return_to_plb_gmf' => 7,
            'last_balance' => 56,
            'date' => '2022-06-26',
        ]);
        MovementAllotment::create([
            'osa' => 'CGK',
            'first_balance' => '82',
            'kno_plus' => Null,
            'kno_min' => Null,
            'upg_plus' => 2,
            'upg_min' => 4,
            'sub_plus' => 0,
            'sub_min' => 0,
            'bpn_plus' => 5,
            'bpn_min' => 1,
            'dps_plus' => 9,
            'dps_min' => 0,
            'cgk_plus' => 0,
            'cgk_min' => 0,
            'consumption_install' => 30,
            'return_to_plb_gmf' => 7,
            'last_balance' => 56,
            'date' => '2022-06-26',
        ]);
    }
}
