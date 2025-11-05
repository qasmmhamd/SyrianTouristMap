<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
       Schema::create('tourist_places', function (Blueprint $table) {
    $table->id('tourist_place_id');
    $table->unsignedBigInteger('place_id');
    $table->float('entry_fee')->nullable();
    $table->string('opening_hours')->nullable();
    $table->timestamps();
    $table->foreign('place_id')->references('place_id')->on('places')->onDelete('cascade');
});
    }

    public function down(): void {
        Schema::dropIfExists('tourist_places');
    }
};
