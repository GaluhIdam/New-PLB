<?php

namespace Database\Seeders;

use App\Models\InventoryAllotment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryAllotmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryAllotment::create([
            'part_number' => '645172-2:70210',
            'from_plant' => 'GADC',
            'to_plant' => 'CGK3',
            'quantity' => '1',
            'unit_code' => 'EA',
        ]);
    }
}
