<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id('rating_id'); // العمود الأساسي مطابق للموديل
            $table->float('value'); // قيمة التقييم
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // علاقة بمستخدم
            $table->foreignId('place_id')->constrained('places')->cascadeOnDelete(); // علاقة بالمكان
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
