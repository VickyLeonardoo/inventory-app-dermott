<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('asset_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('ident_code');
            $table->string('kode_lokasi');
            $table->integer('jumlah');
            $table->foreignId('petugas_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('petugas');
            $table->string('pengaju');
            $table->string('divisi');
            $table->string('status')->default('Belum Dikembalikan');
            $table->text('kondisi_keluar')->nullable();
            $table->text('kondisi_masuk')->nullable();
            $table->timestamps();

            $table->foreign('ident_code')->references('ident_code')->on('location_assets')->cascadeOnDelete();
            $table->foreign('kode_lokasi')->references('kode_lokasi')->on('location_assets')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asset_transactions');
    }
};
