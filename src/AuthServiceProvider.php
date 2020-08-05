<?php

namespace Satifest\AuthToken;

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
    }


    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing(): void
    {
        $this->publishes([
            __DIR__.'/../database/migrations' => \database_path('migrations'),
        ], 'satifest-migrations');
    }

    /**
     * Register Satifest's migration files.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        if (Satifest::$runsMigrations) {
            return $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }
}
