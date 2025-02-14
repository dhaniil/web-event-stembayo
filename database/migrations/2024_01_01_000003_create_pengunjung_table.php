<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengunjung', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('ip_address')->index();
            $table->text('user_agent')->nullable();
            $table->enum('status', ['registered', 'attended', 'cancelled'])->default('registered');
            $table->timestamp('visited_at')->index();
            $table->timestamp('attended_at')->nullable();
            $table->timestamps();

            // Add composite index for faster queries
            $table->index(['event_id', 'ip_address', 'visited_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengunjung');
    }
};
