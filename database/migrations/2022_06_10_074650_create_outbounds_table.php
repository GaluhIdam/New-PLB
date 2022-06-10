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
        Schema::create('outbounds', function (Blueprint $table) {
            $table->id();
            $table->string('part_number')->nullable();
            $table->string('condition')->nullable();
            $table->string('description')->nullable();
            $table->string('quantity')->nullable();
            $table->string('unit_code')->nullable();
            $table->string('register_ac')->nullable();
            $table->string('customer')->nullable();
            $table->string('date_install')->nullable();
            $table->string('date_ac_in')->nullable();
            $table->string('date_ac_out')->nullable();
            $table->string('type_bc_out')->nullable();
            $table->string('no_aju')->nullable();
            $table->string('no_register')->nullable();
            $table->string('cif_idr')->nullable();
            $table->string('date_bc_out')->nullable();
            $table->string('bm_paid')->nullable();
            $table->string('ppn_paid')->nullable();
            $table->string('pph_paid')->nullable();
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
        Schema::dropIfExists('outbounds');
    }
};
