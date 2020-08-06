<?php

namespace Satifest\AuthToken;

use Illuminate\Contracts\Foundation\CachesConfiguration;
use Illuminate\Support\ServiceProvider;
use Satifest\Foundation\Satifest;

class AuthServiceProvider extends ServiceProvider
{
    use BootAuthProvider;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
            $this->registerMigrations();
        }

        $this->BootAuthProvider();

        $this->overrideAuthConfiguration();
    }

    /**
     * Register the package's publishable resources.
     */
    protected function registerPublishing(): void
    {
        $this->publishes([
            __DIR__.'/../database/migrations' => \database_path('migrations'),
        ], 'satifest-migrations');
    }

    /**
     * Register Satifest's migration files.
     */
    protected function registerMigrations(): void
    {
        if (Satifest::$runsMigrations) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

            return ;
        }
    }

    /**
     * Override auth configuration.
     */
    protected function overrideAuthConfiguration(): void
    {
        if ($this->app instanceof CachesConfiguration && ! $this->app->configurationIsCached()) {
            \config([
                'auth.providers.satifest' => [
                    'driver' => 'satifest-token',
                    'model' => Satifest::getUserModel(),
                ],
                'auth.guards.satifest' => [
                    'driver' => 'session',
                    'provider' => 'satifest',
                ],
            ]);
        }
    }
}
