<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();   
            $table->foreignId('region_id')->constrained('regions')->cascadeOnDelete();
            $table->string('google_map_url')->nullable();
            $table->string('image_url')->nullable();
            $table->enum('type', ['historical', 'entertainment', 'service']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
