<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

/**
 * Provider responsável por registrar políticas de autorização.
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Políticas do modelo para autorização.
     *
     * @var array
     */
    protected $policies = [
    ];

    /**
     * Registra as políticas e gates da aplicação.
     *
     * @return void
     */
    public function boot(): void
    {
    }
}
