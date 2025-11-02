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
            Schema::create('indeks_nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('nilai_absensi')->default(0);
            $table->integer('nilai_tugas')->default(0);
            $table->integer('nilai_laporan')->default(0);
            $table->integer('nilai_sikap')->default(0);
            $table->decimal('nilai_akhir', 5, 2)->default(0);
            $table->string('grade')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indeks_nilai');
    }
};
