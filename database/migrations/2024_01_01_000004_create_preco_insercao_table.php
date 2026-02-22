<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela de preços para inserção
     * Armazena preços processados e normalizados
     */
    public function up(): void
    {
        Schema::create('preco_insercao', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->index();
            $table->decimal('preco_normalizado', 10, 2);
            $table->string('moeda_normalizada');
            $table->timestamps();
        });
    }

    /**
     * Desfaz a criação da tabela preco_insercao
     */
    public function down(): void
    {
        Schema::dropIfExists('preco_insercao');
    }
};
