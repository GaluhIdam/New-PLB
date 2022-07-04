<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            MutationReportSeeder::class,
            OutboundSeeder::class,
            UserSeeder::class,
            InventoryAllotmentSeeder::class,
            MovementAllotmentSeeder::class,
            DashboardSatuSeeder::class,
            DashboardDuaSeeder::class,
            DashboardTigaSeeder::class,
            DashboardEmpatSeeder::class,
            DashboardLimaSeeder::class,
        ]);
    }
}
