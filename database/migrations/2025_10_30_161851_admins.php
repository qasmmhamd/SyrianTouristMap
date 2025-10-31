<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id('admin_id');
            $table->unsignedBigInteger('super_admin_id')->nullable(); // 🔗 العلاقة مع super_admins
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();

            // 🔗 المفتاح الأجنبي
            $table->foreign('super_admin_id')
                  ->references('super_admin_id')
                  ->on('super_admins')
                  ->onDelete('set null'); // لو حذف السوبر أدمن، تتحول القيمة إلى null
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};

