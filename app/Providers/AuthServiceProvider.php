<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Aquí puedes definir gates si lo necesitas
        // Gate::define('ver-productos', fn ($user) => $user->hasPermission('ver-productos'));
    }
}
// Este archivo es donde se configuran las políticas de autorización y autenticación de la aplicación.
// Puedes definir políticas para diferentes modelos y establecer permisos específicos para los usuarios.
