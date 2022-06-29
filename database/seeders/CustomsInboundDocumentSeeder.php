<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomsInboundDocument;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomsInboundDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomsInboundDocument::create([
            'document_type' => '41',
            'no_aju' => '05014100558620210822018786',
            'date_aju' => Carbon::now(),
            'no_register' => '000643',
            'date_register' => Carbon::now(),
            'date_inbound' => Carbon::now(),
            'sender' => 'GARUDA',
            'owner' => 'GARUDA',
            'item_code' => 'BC9234',
            'hs_code' => 'NA43124',
            'item_name' => 'FIRST AID KIT',
            'quantity' => '2000',
            'unit' => 'PCE',
            'item_value' => '3123123',
            'attachment' => '',
        ]);

        CustomsInboundDocument::create([
            'document_type' => '41',
            'no_aju' => '07864100558620210822018786',
            'date_aju' => Carbon::now()->addDays(1),
            'no_register' => '000643',
            'date_register' => Carbon::now()->addDays(1),
            'date_inbound' => Carbon::now()->addDays(1),
            'sender' => 'SENTRA',
            'owner' => 'SENTRA',
            'item_code' => 'BC9234',
            'hs_code' => 'NA43124',
            'item_name' => 'FIRST AID KIT',
            'quantity' => '2000',
            'unit' => 'PCE',
            'item_value' => '3123123',
            'attachment' => '',
        ]);

        CustomsInboundDocument::create([
            'document_type' => '16',
            'no_aju' => '09876778832222090900',
            'date_aju' => Carbon::now()->addDays(2),
            'no_register' => '000643',
            'date_register' => Carbon::now()->addDays(2),
            'date_inbound' => Carbon::now()->addDays(2),
            'sender' => 'VANA',
            'owner' => 'VANA',
            'item_code' => 'BC9234',
            'hs_code' => 'NA43124',
            'item_name' => 'FIRST AID KIT',
            'quantity' => '2000',
            'unit' => 'PCE',
            'item_value' => '3123123',
            'attachment' => '',
        ]);
    }
}