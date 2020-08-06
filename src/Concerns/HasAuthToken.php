<?php

namespace Satifest\AuthToken\Concerns;

use Satifest\AuthToken\Observers\UserObserver;
use Satifest\Foundation\Satifest;

trait HasAuthToken
{
    /**
     * Boot Has Auth Token trait.
     */
    public static function bootHasAuthToken(): void
    {
        static::observe(new UserObserver());
    }

    /**
     * Initialize Has Auth Token trait.
     */
    public function initializeHasAuthToken(): void
    {
        $this->hidden[] = Satifest::getAuthTokenName();
    }

    /**
     * Get the auth token value.
     */
    public function getSatifestAuthToken(): string
    {
        return $this->getAttribute(Satifest::getAuthTokenName());
    }
}
