<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela de produtos para inserção
     * Armazena produtos processados e normalizados
     */
    public function up(): void
    {
        Schema::create('produto_insercao', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique()->index();
            $table->string('nome_normalizado');
            $table->text('descricao_normalizada')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Desfaz a criação da tabela produto_insercao
     */
    public function down(): void
    {
        Schema::dropIfExists('produto_insercao');
    }
};
