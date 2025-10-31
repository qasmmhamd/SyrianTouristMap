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
         Schema::create('places', function (Blueprint $table) {
    $table->id('place_id');
    $table->string('name');
    $table->string('description')->nullable();
    $table->string('location');
    $table->string('image_url')->nullable();
    $table->unsignedBigInteger('region_id'); 
    $table->string('type');
    $table->timestamps();
    $table->foreign('region_id') ->references('region_id')->on('regions')->onDelete('cascade');
});


           
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('Places');

    }
};
