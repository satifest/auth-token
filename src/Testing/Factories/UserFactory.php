<?php

namespace Satifest\AuthToken\Testing\Factories;

use Illuminate\Support\Str;
use Satifest\AuthToken\Testing\User;
use Satifest\Foundation\Satifest;

class UserFactory extends \Satifest\Foundation\Testing\Factories\UserFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return \array_merge(parent::definition(), [
            Satifest::getAuthTokenName() => Str::random(6),
        ]);
    }
}
