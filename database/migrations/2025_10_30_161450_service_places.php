<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_places', function (Blueprint $table) {
            $table->id('service_place_id');
            $table->unsignedBigInteger('place_id')->unique();
            $table->string('service_type'); // hotel, hospital, gas_station, etc.
            $table->string('working_hours')->nullable();
            $table->string('contact')->nullable();
            $table->timestamps();

            $table->foreign('place_id')
                  ->references('place_id')->on('places')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_places');
    }
};
