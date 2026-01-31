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

        Schema::create('tickets', function (Blueprint $table) {
            // Chave primária
            $table->id();

            // Dados principais do chamado
            $table->string('title');
            $table->text('description');

            // Status do chamado
            // Regra: status padrão deve ser "aberto"
            $table->string('status')->default('open');

            // Relacionamento com categoria (obrigatório)
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->restrictOnDelete();

            // Quem criou o chamado
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
        Schema::dropIfExists('tickets');
    }
};
