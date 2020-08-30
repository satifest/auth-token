<?php

namespace Satifest\AuthToken\Testing;

use Satifest\AuthToken\Concerns\HasAuthToken;

class User extends \Satifest\Foundation\Testing\User
{
    use HasAuthToken;
}
