<?php

namespace Satifest\AuthToken\Listeners;

use Illuminate\Support\Facades\Artisan;
use Orchestra\Installation\Events\Event;

class MigrateDatabaseSchema
{
    /**
     * Handle the event.
     *
     * @param  \Orchestra\Installation\Events\Event  $event
     *
     * @return void
     */
    public function handle(Event $event)
    {
        Artisan::call('migrate', [
            '--no-interaction' => true,
            '--path' => realpath(__DIR__.'/../../database/migrations'),
            '--realpath' => true,
        ]);
    }
}
