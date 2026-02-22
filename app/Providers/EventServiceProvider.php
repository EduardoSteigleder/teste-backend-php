<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Provider de eventos da aplicação.
 *
 * Mapeia eventos para listeners e controla descoberta automática.
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * Lista de eventos e listeners.
     *
     * @var array
     */
    protected $listen = [
    ];

    /**
     * Registro de boot dos listeners.
     *
     * @return void
     */
    public function boot(): void
    {
    }

    /**
     * Define se os eventos devem ser descobertos automaticamente.
     *
     * @return bool
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
