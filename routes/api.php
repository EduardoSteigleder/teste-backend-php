<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SincronizacaoController;

// Rotas da API (stateless, sem CSRF)
Route::post('/sincronizar/produtos', [SincronizacaoController::class, 'sincronizarProdutos']);
Route::post('/sincronizar/precos', [SincronizacaoController::class, 'sincronizarPrecos']);
Route::get('/produtos-precos', [SincronizacaoController::class, 'listarProdutosPrecos']);
