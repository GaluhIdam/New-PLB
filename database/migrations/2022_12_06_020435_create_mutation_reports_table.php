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
            $table->string('kode_barang', 100)->nullable();
            $table->string('uraian', 255)->nullable();
            $table->string('kode_satuan', 50)->nullable();
            $table->integer('saldo_awal')->nullable();
            $table->integer('saldo_akhir')->nullable();
            $table->integer('saldo_penyesuaian')->nullable();
            $table->string('tipe_saldo', 100)->nullable();
            $table->dateTime('uploaded_at')->nullable();
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
        Schema::dropIfExists('tbl_mutation_reports');
    }
};
