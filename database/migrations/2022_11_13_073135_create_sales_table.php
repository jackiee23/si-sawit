<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_jual');
            $table->char('jumlah');
            $table->char('sortasi');
            $table->char('jumlah_net');
            $table->char('potongan');
            $table->char('harga_pabrik');
            $table->char('harga_total');
            $table->foreignId('worker_id');
            $table->foreignId('car_id');
            $table->string('pabrik')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
