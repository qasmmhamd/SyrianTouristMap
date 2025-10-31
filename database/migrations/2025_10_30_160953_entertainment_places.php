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
        Schema::create('entertainment_places', function (Blueprint $table) {
    $table->id('entertainment_place_id');
    $table->unsignedBigInteger('place_id');
    $table->string('category'); // restaurant, cafe, theatre...
    $table->string('menu_or_program')->nullable();
    $table->timestamps();
    $table->foreign('place_id')->references('place_id')->on('places')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
                Schema::dropIfExists('entertainment_places');

    }
};
