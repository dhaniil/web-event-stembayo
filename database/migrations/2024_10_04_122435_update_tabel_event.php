<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->date('date');
            $table->text('description');
            $table->string('type');
            $table->binary('image');
            $table->enum('sekbid', [
                'KTYME Islam', 
                'KTYME Kristiani', 
                'KBBP', 
                'KBPL', 
                'BPPK', 
                'KK', 
                'PAKS', 
                'KJDK', 
                'PPBN',
                '-', 
                'HUMTIK'
            ])->default('-'); 
            $table->string('penyelenggara')->default('-'); 
            $table->timestamps();
        
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};