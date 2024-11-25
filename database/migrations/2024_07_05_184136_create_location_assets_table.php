<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('location_assets', function (Blueprint $table) {
            $table->id();
            $table->string('kode_lokasi');
            $table->string('ident_code');
            $table->text('deskripsi');
            $table->foreignId('petugas_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('petugas');
            $table->integer('stok');
            $table->timestamps();

            $table->foreign('kode_lokasi')->references('kode_lokasi')->on('locations')->onDelete('cascade');
            $table->foreign('ident_code')->references('ident_code')->on('assets')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('location_assets');
    }
};
