<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id('rating_id');
            $table->float('value');        
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();      
            $table->foreignId('place_id')->constrained('places')->cascadeOnDelete();  
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
