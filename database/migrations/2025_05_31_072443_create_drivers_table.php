<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo'); // misal: disimpan di storage/app/public
            $table->string('location');
            $table->string('telepon');
            $table->string('email');
            $table->text('description');
            $table->enum('vehicle_type', ['motor', 'mobil']);
            $table->timestamps();
        });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
