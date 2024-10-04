<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id(); // ID unik untuk setiap tiket
            $table->foreignId('event_id')->constrained()->onDelete('cascade'); // Relasi dengan tabel events
            $table->string('qr_code')->unique(); // QR Code unik
            $table->timestamp('valid_until'); // Masa berlaku tiket
            $table->decimal('price', 10, 2); // Harga tiket
            $table->enum('type', ['VIP', 'Reguler', 'VVIP']); // Jenis tiket
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
