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
        Schema::create('categories', function (Blueprint $table) {

            // Chave primária
            $table->id();

            // Nome da categoria
            $table->string('name')->unique();

            // Quem criou a categoria (por enquanto só um inteiro)
            // No futuro pode virar foreign key para users
            $table->unsignedBigInteger('created_by')->nullable();

            // created_at e updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
