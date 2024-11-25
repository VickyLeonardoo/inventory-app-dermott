<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->string('kode_lokasi')->primary();
            $table->string('name');
            $table->text('detail_lokasi');
            $table->decimal('koordinat_x', 10, 7);
            $table->decimal('koordinat_y', 10, 7);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('locations');
    }
};
