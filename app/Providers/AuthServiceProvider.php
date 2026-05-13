<?php

namespace App\Providers;

use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Pagamento;
use App\Policies\ClientePolicy;
use App\Policies\CompraPolicy;
use App\Policies\PagamentoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Cliente::class => ClientePolicy::class,
        Compra::class => CompraPolicy::class,
        Pagamento::class => PagamentoPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Boot the application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
