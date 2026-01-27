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
        Schema::create('presensi_dosens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perkuliahan_id')->constrained();
            $table->date('tanggal');
            $table->integer('pertemuan_ke');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_dosens');
    }
};
