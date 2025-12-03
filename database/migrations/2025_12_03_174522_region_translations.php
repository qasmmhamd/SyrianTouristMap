<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('region_translations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('region_id')
                ->constrained('regions')
                ->cascadeOnDelete();

            $table->string('locale'); // ar | en
            $table->string('name');   // اسم المنطقة
            $table->text('description')->nullable(); // وصف المنطقة

            $table->timestamps();

            $table->unique(['region_id', 'locale']); // منع تكرار نفس اللغة لنفس المنطقة
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('region_translations');
    }
};
