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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->date('date'); // Tanggal kunjungan
            $table->integer('visit_count'); // Jumlah kunjungan
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();   // User-Agent pengunjung (browser)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
