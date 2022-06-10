<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomsInboundDocument;
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
            'date_aju' => '2021-08-22',
            'no_register' => '000643',
            'date_register' => '2021-08-22',
            'date_inbound' => '2021-08-22',
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
            'date_aju' => '2021-08-22',
            'no_register' => '000643',
            'date_register' => '2021-08-22',
            'date_inbound' => '2021-08-22',
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
            'document_type' => '41',
            'no_aju' => '09876100558620210822018786',
            'date_aju' => '2021-08-22',
            'no_register' => '000643',
            'date_register' => '2021-08-22',
            'date_inbound' => '2021-08-22',
            'sender' => 'MEDIKA',
            'owner' => 'MEDIKA',
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
