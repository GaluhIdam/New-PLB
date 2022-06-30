<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\CustomsOutboundDocument;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomsOutboundDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomsOutboundDocument::create([
            'document_type' => '16',
            'no_aju' => '1122330558620210822018786',
            'date_aju' => Carbon::now(),
            'no_register' => '000643',
            'date_register' => Carbon::now(),
            'date_outbound' => Carbon::now(),
            'owner' => 'VANTURE',
            'item_code' => '6240-35:C5307',
            'hs_code' => 'CX342',
            'item_name' => 'FIRST AID KIT',
            'quantity' => '3.000',
            'unit' => 'EA',
            'item_value' => '500000.00',
            'attachment' => '',
        ]);

        CustomsOutboundDocument::create([
            'document_type' => '41',
            'no_aju' => '05014100558620210822018786',
            'date_aju' => Carbon::now()->addDays(1),
            'no_register' => '000643',
            'date_register' => Carbon::now()->addDays(1),
            'date_outbound' => Carbon::now()->addDays(1),
            'owner' => 'GARUDA',
            'item_code' => '6240-35:C5307',
            'hs_code' => 'CX342',
            'item_name' => 'FIRST AID KIT',
            'quantity' => '1.0000',
            'unit' => 'EA',
            'item_value' => '500000.00',
            'attachment' => '',
        ]);

        CustomsOutboundDocument::create([
            'document_type' => '41',
            'no_aju' => '09084100558620210822018786',
            'date_aju' => Carbon::now()->addDays(2),
            'no_register' => '000643',
            'date_register' => Carbon::now()->addDays(2),
            'date_outbound' => Carbon::now()->addDays(2),
            'owner' => 'SENTRA',
            'item_code' => '6240-35:C5307',
            'hs_code' => 'CX342',
            'item_name' => 'FIRST AID KIT',
            'quantity' => '1.0000',
            'unit' => 'EA',
            'item_value' => '500000.00',
            'attachment' => '',
        ]);

        CustomsOutboundDocument::create([
            'document_type' => '41',
            'no_aju' => '05614100558620210822018786',
            'date_aju' => Carbon::now()->addDays(3),
            'no_register' => '000643',
            'date_register' => Carbon::now()->addDays(3),
            'date_outbound' => Carbon::now()->addDays(3),
            'owner' => 'MEDIKA',
            'item_code' => '6240-35:C5307',
            'hs_code' => 'CX342',
            'item_name' => 'FIRST AID KIT',
            'quantity' => '1.0000',
            'unit' => 'EA',
            'item_value' => '500000.00',
            'attachment' => '',
        ]);
    }
}