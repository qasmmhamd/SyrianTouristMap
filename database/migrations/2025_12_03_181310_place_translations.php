<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('place_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('place_id')->constrained('places')->cascadeOnDelete();
            $table->string('locale'); // ar | en
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('location');
            $table->timestamps();
            $table->unique(['place_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('place_translations');
    }
};
