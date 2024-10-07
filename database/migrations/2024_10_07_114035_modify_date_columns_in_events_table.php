<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDateColumnsInEventsTable extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('date', 'start_date');

            // Tambahkan kolom 'end_date' dengan nullable
            $table->date('end_date')->nullable()->after('start_date');
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('start_date', 'date');
            $table->dropColumn('end_date');
        });
    }
}
