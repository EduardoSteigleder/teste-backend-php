<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Cria as views de processamento de dados
     * view_produtos_processados: Normaliza e filtra produtos ativos
     * view_precos_processados: Normaliza e filtra preços ativos
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW IF NOT EXISTS view_produtos_processados AS
            SELECT 
                p.id,
                p.sku,
                UPPER(TRIM(p.nome)) as nome_normalizado,
                UPPER(TRIM(COALESCE(p.descricao, ''))) as descricao_normalizada,
                p.ativo,
                p.created_at,
                p.updated_at
            FROM produtos_base p
            WHERE p.ativo = 1
        ");

        DB::statement("
            CREATE VIEW IF NOT EXISTS view_precos_processados AS
            SELECT 
                pr.id,
                pr.sku,
                ROUND(pr.preco, 2) as preco_normalizado,
                UPPER(TRIM(pr.moeda)) as moeda_normalizada,
                pr.ativo,
                pr.created_at,
                pr.updated_at
            FROM precos_base pr
            WHERE pr.ativo = 1
        ");
    }

    /**
     * Desfaz a criação das views
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS view_precos_processados");
        DB::statement("DROP VIEW IF EXISTS view_produtos_processados");
    }
};
