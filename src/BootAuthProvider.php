<?php

namespace Satifest\AuthToken;

use Illuminate\Support\Facades\Auth;

trait BootAuthProvider
{
    /**
     * Register token user provider.
     *
     * @return void
     */
    protected function bootAuthProvider(): void
    {
        Auth::provider('satifest-token', static function ($app, array $config) {
            return new UserProvider($app->make('hash'), $config['model']);
        });
    }
}
