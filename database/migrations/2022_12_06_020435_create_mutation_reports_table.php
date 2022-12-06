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
        Schema::create('tbl_mutation_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('part_number', 100)->nullable();
            $table->string('part_name', 255)->nullable();
            $table->string('unit', 50)->nullable();
            $table->integer('saldo_awal')->nullable();
            $table->integer('saldo_akhir')->nullable();
            $table->integer('saldo_penyesuaian')->nullable();
            $table->string('saldo_type', 100)->nullable();
            $table->dateTime('uploaded_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_mutation_reports');
    }
};