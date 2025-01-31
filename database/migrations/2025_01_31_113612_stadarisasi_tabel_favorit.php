<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('favourites', function (Blueprint $table) {
            // Backup data jika perlu
            if (Schema::hasColumn('favourites', 'events_id')) {
                DB::statement('UPDATE favourites SET event_id = events_id');
                $table->dropColumn('events_id');
            }
            
            // Pastikan kolom event_id ada
            if (!Schema::hasColumn('favourites', 'event_id')) {
                $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('favourites', function (Blueprint $table) {
            $table->foreignId('events_id')->after('user_id')->nullable();
            DB::statement('UPDATE favourites SET events_id = event_id');
            $table->dropColumn('event_id');
        });
    }
};