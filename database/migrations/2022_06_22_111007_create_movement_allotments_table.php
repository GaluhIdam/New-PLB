<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movement_allotments', function (Blueprint $table) {
            $table->id();
            $table->string('osa')->nullable();
            $table->integer('first_balance')->nullable();
            $table->integer('kno_plus')->nullable();
            $table->integer('kno_min')->nullable();
            $table->integer('upg_plus')->nullable();
            $table->integer('upg_min')->nullable();
            $table->integer('sub_plus')->nullable();
            $table->integer('sub_min')->nullable();
            $table->integer('bpn_plus')->nullable();
            $table->integer('bpn_min')->nullable();
            $table->integer('dps_plus')->nullable();
            $table->integer('dps_min')->nullable();
            $table->integer('cgk_plus')->nullable();
            $table->integer('cgk_min')->nullable();
            $table->integer('consumption_install')->nullable();
            $table->integer('return_to_plb_gmf')->nullable();
            $table->integer('last_balance')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movement_allotments');
    }
};
