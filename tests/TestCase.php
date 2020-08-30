<?php

namespace Satifest\AuthToken\Tests;

use Satifest\AuthToken\Testing\User;
use Satifest\Foundation\Satifest;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        $this->afterApplicationRefreshed(function () {
            $this->loadLaravelMigrations();
        });

        parent::setUp();
    }
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        Satifest::setUserModel(User::class);
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            'Satifest\Foundation\SatifestServiceProvider',
            'Satifest\AuthToken\AuthServiceProvider',
        ];
    }
}
