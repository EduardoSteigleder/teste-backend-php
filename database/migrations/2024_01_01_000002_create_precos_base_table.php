<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela de preços base da base externa
     * Relaciona preços com produtos via SKU
     */
    public function up(): void
    {
        Schema::create('precos_base', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->decimal('preco', 10, 2);
            $table->string('moeda')->default('BRL');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Desfaz a criação da tabela precos_base
     */
    public function down(): void
    {
        Schema::dropIfExists('precos_base');
    }
};
