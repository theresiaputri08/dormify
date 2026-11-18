<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {

            $table->foreignId('category_id')
                ->nullable()
                ->after('title')
                ->constrained('categories')
                ->nullOnDelete();

            $table->foreignId('dormitory_id')
                ->nullable()
                ->after('category_id')
                ->constrained('dormitories')
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
            $table->dropConstrainedForeignId('dormitory_id');
        });
    }
};