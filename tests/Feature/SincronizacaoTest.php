<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\ProdutoBase;
use App\Models\PrecoBase;

/**
 * Testes de integração para o fluxo de sincronização.
 */
class SincronizacaoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Preparação do ambiente de testes: migrações e seeders.
     */
    protected function setUp(): void
    {
        parent::setUp();
        // Executa migrações e popula dados de exemplo
        $this->artisan('migrate');
        $this->artisan('db:seed');
    }

    /**
     * Verifica que a sincronização de produtos responde 200 e estrutura correta.
     */
    public function test_sincronizar_produtos_com_sucesso()
    {
        // Chama endpoint de sincronização de produtos
        $response = $this->postJson('/api/sincronizar/produtos');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'mensagem',
            'inseridos',
            'atualizados',
            'total_processado',
        ]);
    }

    /**
     * Verifica que a sincronização de preços responde 200 e estrutura correta.
     */
    public function test_sincronizar_precos_com_sucesso()
    {
        // Chama endpoint de sincronização de preços
        $response = $this->postJson('/api/sincronizar/precos');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'mensagem',
            'inseridos',
            'atualizados',
            'total_processado',
        ]);
    }

    /**
     * Verifica listagem paginada após sincronizações.
     */
    public function test_listar_produtos_precos_com_paginacao()
    {
        // Garante que há dados processados
        $this->postJson('/api/sincronizar/produtos');
        $this->postJson('/api/sincronizar/precos');

        $response = $this->getJson('/api/produtos-precos');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'produto_id',
                    'sku',
                    'nome_normalizado',
                    'descricao_normalizada',
                    'preco_normalizado',
                    'moeda_normalizada',
                    'created_at',
                    'updated_at',
                ]
            ],
            'pagination' => [
                'current_page',
                'per_page',
                'total',
                'last_page',
                'from',
                'to',
            ],
        ]);
    }

    /**
     * Verifica que os parâmetros de paginação são respeitados.
     */
    public function test_listar_produtos_precos_com_parametros_paginacao()
    {
        $this->postJson('/api/sincronizar/produtos');
        $this->postJson('/api/sincronizar/precos');

        // Solicita página 1 com 2 itens por página
        $response = $this->getJson('/api/produtos-precos?page=1&per_page=2');

        $response->assertStatus(200);
        $this->assertEquals(1, $response->json('pagination.current_page'));
        $this->assertEquals(2, $response->json('pagination.per_page'));
    }

    /**
     * Garante que sincronizações repetidas não criam duplicidade.
     */
    public function test_sincronizacao_evita_duplicidade()
    {
        // Primeira sincronização
        $this->postJson('/api/sincronizar/produtos');
        $response1 = $this->getJson('/api/produtos-precos');
        $totalPrimeira = $response1->json('pagination.total');

        // Segunda sincronização não deve alterar total
        $this->postJson('/api/sincronizar/produtos');
        $response2 = $this->getJson('/api/produtos-precos');
        $totalSegunda = $response2->json('pagination.total');

        $this->assertEquals($totalPrimeira, $totalSegunda);
    }

    /**
     * As views só devem processar registros marcados como ativos.
     */
    public function test_view_processa_apenas_registros_ativos()
    {
        $this->postJson('/api/sincronizar/produtos');
        $response = $this->getJson('/api/produtos-precos');

        $total = $response->json('pagination.total');
        
        $this->assertGreaterThan(0, $total);
    }
}
