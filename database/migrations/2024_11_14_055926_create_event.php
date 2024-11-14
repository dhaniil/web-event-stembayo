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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start_date');
            $table->time('jam_mulai');
            $table->date('end_date')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->text('description')->nullable();
            $table->string('tempat')->nullable();
            $table->string('type')->nullable();
            $table->binary('image')->nullable();
            $table->string('kategori')->nullable();
            $table->string('penyelenggara')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
