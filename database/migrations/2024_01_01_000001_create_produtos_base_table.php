<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela de produtos base da base externa
     * Armazena os produtos originais com informações de ativação
     */
    public function up(): void
    {
        Schema::create('produtos_base', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Desfaz a criação da tabela produtos_base
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos_base');
    }
};
