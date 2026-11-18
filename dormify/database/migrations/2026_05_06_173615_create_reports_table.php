<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('sender_name')->nullable();
            $table->string('title');

            $table->text('description');

            $table->boolean('is_anonymous')->default(false);

            $table->string('proof_image')->nullable();

            $table->enum('status', [
                'Pending',
                'Diproses',
                'Selesai'
            ])->default('Pending');

            $table->text('admin_response')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};