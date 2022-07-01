<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\OutboundSeeder;
use Database\Seeders\DashboardDuaSeeder;
use Database\Seeders\HoardingTimeSeeder;
use Database\Seeders\LoginHistorySeeder;
use Database\Seeders\DashboardLimaSeeder;
use Database\Seeders\DashboardSatuSeeder;
use Database\Seeders\DashboardTigaSeeder;
use Database\Seeders\DashboardEmpatSeeder;
use Database\Seeders\MutationReportSeeder;
use Database\Seeders\ActivityHistorySeeder;
use Database\Seeders\MutationPeriodicSeeder;
use Database\Seeders\MovementAllotmentSedder;
use Database\Seeders\InventoryAllotmentSeeder;
use Database\Seeders\CustomsInboundDocumentSeeder;
use Database\Seeders\CustomsOutboundDocumentSeeder;
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
            MovementAllotmentSedder::class,
            DashboardSatuSeeder::class,
            DashboardDuaSeeder::class,
            DashboardTigaSeeder::class,
            DashboardEmpatSeeder::class,
            DashboardLimaSeeder::class,
        ]);
    }
}
