<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Service provider de aplicação.
 *
 * Aqui ficam bindings e bootstrapping específicos da aplicação.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra bindings no container de serviços.
     *
     * @return void
     */
    public function register(): void
    {
    }

    /**
     * Inicialização de serviços e configuração em tempo de boot.
     *
     * @return void
     */
    public function boot(): void
    {
    }
}
