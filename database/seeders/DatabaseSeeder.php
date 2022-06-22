<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CustomsInboundDocumentSeeder::class,
            CustomsOutboundDocumentSeeder::class,
            HoardingTimeSeeder::class,
            LoginHistorySeeder::class,
            ActivityHistorySeeder::class,
            MutationPeriodicSeeder::class,
            MutationSeeder::class,
            OutboundSeeder::class,
            UserSeeder::class,
            InventoryAllotmentSeeder::class
        ]);
    }
}
