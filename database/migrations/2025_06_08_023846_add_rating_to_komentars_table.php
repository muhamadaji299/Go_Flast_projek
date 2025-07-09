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
        Schema::table('komentars', function (Blueprint $table) {
            Schema::table('komentars', function (Blueprint $table) {
                $table->unsignedTinyInteger('rating')->after('isi');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('komentars', function (Blueprint $table) {
            //
        });
    }
};
