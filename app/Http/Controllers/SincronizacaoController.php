<?php

namespace App\Http\Controllers;

use App\Models\ProdutoBase;
use App\Models\PrecoBase;
use App\Models\ProdutoInsercao;
use App\Models\PrecoInsercao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Controller responsável pela sincronização de dados
 * entre as bases de dados externas e o banco interno
 */
class SincronizacaoController extends Controller
{
    /**
     * Sincroniza produtos da view_produtos_processados
     * para a tabela produto_insercao
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function sincronizarProdutos()
    {
        try {
            DB::beginTransaction();

            $produtosProcessados = DB::select("
                SELECT * FROM view_produtos_processados
            ");

            $contadorInsercao = 0;
            $contadorAtualizacao = 0;

            foreach ($produtosProcessados as $produto) {
                $existe = ProdutoInsercao::where('sku', $produto->sku)->first();

                if ($existe) {
                    if ($existe->nome_normalizado !== $produto->nome_normalizado || 
                        $existe->descricao_normalizada !== $produto->descricao_normalizada) {
                        $existe->update([
                            'nome_normalizado' => $produto->nome_normalizado,
                            'descricao_normalizada' => $produto->descricao_normalizada,
                        ]);
                        $contadorAtualizacao++;
                    }
                } else {
                    ProdutoInsercao::create([
                        'sku' => $produto->sku,
                        'nome_normalizado' => $produto->nome_normalizado,
                        'descricao_normalizada' => $produto->descricao_normalizada,
                    ]);
                    $contadorInsercao++;
                }
            }

            $skusAtivos = array_map(fn($p) => $p->sku, $produtosProcessados);
            ProdutoInsercao::whereNotIn('sku', $skusAtivos)->delete();

            DB::commit();

            return response()->json([
                'mensagem' => 'Sincronização de produtos realizada com sucesso',
                'inseridos' => $contadorInsercao,
                'atualizados' => $contadorAtualizacao,
                'total_processado' => count($produtosProcessados),
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'erro' => 'Erro ao sincronizar produtos',
                'detalhes' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Sincroniza preços da view_precos_processados
     * para a tabela preco_insercao
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function sincronizarPrecos()
    {
        try {
            DB::beginTransaction();

            $precosProcessados = DB::select("
                SELECT * FROM view_precos_processados
            ");

            $contadorInsercao = 0;
            $contadorAtualizacao = 0;

            foreach ($precosProcessados as $preco) {
                $existe = PrecoInsercao::where('sku', $preco->sku)->first();

                if ($existe) {
                    if ($existe->preco_normalizado != $preco->preco_normalizado || 
                        $existe->moeda_normalizada !== $preco->moeda_normalizada) {
                        $existe->update([
                            'preco_normalizado' => $preco->preco_normalizado,
                            'moeda_normalizada' => $preco->moeda_normalizada,
                        ]);
                        $contadorAtualizacao++;
                    }
                } else {
                    PrecoInsercao::create([
                        'sku' => $preco->sku,
                        'preco_normalizado' => $preco->preco_normalizado,
                        'moeda_normalizada' => $preco->moeda_normalizada,
                    ]);
                    $contadorInsercao++;
                }
            }

            $skusAtivos = array_map(fn($p) => $p->sku, $precosProcessados);
            PrecoInsercao::whereNotIn('sku', $skusAtivos)->delete();

            DB::commit();

            return response()->json([
                'mensagem' => 'Sincronização de preços realizada com sucesso',
                'inseridos' => $contadorInsercao,
                'atualizados' => $contadorAtualizacao,
                'total_processado' => count($precosProcessados),
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'erro' => 'Erro ao sincronizar preços',
                'detalhes' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Lista produtos e preços processados com paginação
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listarProdutosPrecos(Request $request)
    {
        try {
            $perPage = $request->query('per_page', 10);
            $page = $request->query('page', 1);

            $perPage = min(max((int)$perPage, 1), 100);
            $page = max((int)$page, 1);

            $resultado = DB::table('produto_insercao as p')
                ->leftJoin('preco_insercao as pr', 'p.sku', '=', 'pr.sku')
                ->select([
                    'p.id as produto_id',
                    'p.sku',
                    'p.nome_normalizado',
                    'p.descricao_normalizada',
                    'pr.preco_normalizado',
                    'pr.moeda_normalizada',
                    'p.created_at',
                    'p.updated_at',
                ])
                ->paginate($perPage, ['*'], 'page', $page);

            return response()->json([
                'data' => $resultado->items(),
                'pagination' => [
                    'current_page' => $resultado->currentPage(),
                    'per_page' => $resultado->perPage(),
                    'total' => $resultado->total(),
                    'last_page' => $resultado->lastPage(),
                    'from' => $resultado->firstItem(),
                    'to' => $resultado->lastItem(),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 'Erro ao listar produtos e preços',
                'detalhes' => $e->getMessage(),
            ], 500);
        }
    }
}
