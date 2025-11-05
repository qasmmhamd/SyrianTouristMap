<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('places', function (Blueprint $table) {
            if (Schema::hasColumn('places', 'image_url')) {
                $table->dropColumn('image_url');
            }

            if (Schema::hasColumn('places', 'description')) {
                $table->text('description')->nullable()->change();
            }

            if (Schema::hasColumn('places', 'type')) {
                $table->enum('type', ['historical', 'entertainment', 'service'])->change();
            }
        });
    }

   
    public function down(): void
    {
        Schema::table('places', function (Blueprint $table) {
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
