<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historical_places', function (Blueprint $table) {
            $table->id('historical_place_id');
            $table->unsignedBigInteger('place_id')->unique();
            $table->string('era')->nullable(); // العصر/الحقبة
            $table->string('architectural_style')->nullable();
            $table->text('history_information')->nullable();
            $table->timestamps();

            $table->foreign('place_id')
                  ->references('place_id')->on('places')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historical_places');
    }
};
