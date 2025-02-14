<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favourites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('events_id')->constrained('events')->onDelete('cascade');
            $table->timestamps();

            // Prevent duplicate favourites
            $table->unique(['user_id', 'events_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favourites');
    }
};
