<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rusak_dalams', function (Blueprint $table) {
            $table->id('id_rusak_dalam');
            $table->string('id_pj');
            $table->string('id_barang');
            $table->integer('jumlah_rusak');
            $table->string('id_ruangan');
            $table->string('tanggal_rusak');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rusak_dalams');
    }
};
