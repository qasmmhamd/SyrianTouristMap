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
        Schema::table('places', function (Blueprint $table) {
            // 🗑️ 1. حذف عمود الصورة المفردة لأنه أصبح لدينا جدول images
            if (Schema::hasColumn('places', 'image_url')) {
                $table->dropColumn('image_url');
            }

            // ✏️ 2. تعديل عمود الوصف ليكون text بدل string
            if (Schema::hasColumn('places', 'description')) {
                $table->text('description')->nullable()->change();
            }

            // 🧩 3. تعديل عمود النوع ليكون enum بثلاث قيم محددة
            if (Schema::hasColumn('places', 'type')) {
                $table->enum('type', ['historical', 'entertainment', 'service'])->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('places', function (Blueprint $table) {
            // 🔄 إعادة العمود في حال rollback
            if (!Schema::hasColumn('places', 'image_url')) {
                $table->string('image_url')->nullable();
            }

            if (Schema::hasColumn('places', 'description')) {
                $table->string('description')->nullable()->change();
            }

            if (Schema::hasColumn('places', 'type')) {
                $table->string('type')->change();
            }
        });
    }
};
