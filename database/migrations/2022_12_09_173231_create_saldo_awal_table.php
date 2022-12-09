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
        Schema::create('tbl_saldo_awal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_barang', 100)->nullable();
            $table->string('nama_barang', 255)->nullable();
            $table->string('satuan', 50)->nullable();
            $table->decimal('saldo_awal', 38, 4)->nullable();
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
        Schema::dropIfExists('tbl_saldo_awal');
    }
};
