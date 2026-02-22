<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * Service provider responsável por carregar as rotas da aplicação.
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * Caminho padrão para a home após login.
     */
    public const HOME = '/home';

    /**
     * Defina o mapeamento e boot das rotas aqui.
     *
     * @return void
     */
    public function boot(): void
    {
    }
}
