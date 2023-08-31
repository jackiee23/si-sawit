<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_id');
            $table->date('tgl_beli');
            $table->date('tgl_panen');
            $table->string('selisih');
            $table->char('jumlah_sawit');
            $table->char('ton');
            $table->char('harga');
            $table->char('harga_total');
            $table->foreignId('worker_id');
            // $table->foreignId('worker_id2');
            $table->foreignId('car_id');
            // $table->foreignId('car_id2');
            $table->char('trip')->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
