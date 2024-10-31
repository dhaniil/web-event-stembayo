<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlaceAndTimeToEventsTable extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('tempat')->after('description');
            $table->time('jam_mulai')->after('start_date');
            $table->time('jam_selesai')->after('end_date');
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['tempat', 'jam_mulai', 'jam_selesai']);
        });
    }
}