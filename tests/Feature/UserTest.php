<?php

namespace Satifest\AuthToken\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Satifest\AuthToken\Testing\Factories\UserFactory;
use Satifest\AuthToken\Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_proper_signature()
    {
        $user = UserFactory::new()->create([
            'satifest_token' => 'secret',
        ]);

        $this->assertSame('secret', $user->getSatifestAuthToken());
        $this->assertTrue(in_array('satifest_token', $user->getHidden()));
    }

    /** @test */
    public function it_can_authenticate_using_token()
    {
        $user = UserFactory::new()->create([
            'satifest_token' => 'secret',
        ]);

        $this->assertTrue(Auth::guard('satifest')->validate([
            'email' => $user->email,
            'password' => 'secret',
        ]));

        $this->assertFalse(Auth::guard('satifest')->validate([
            'email' => $user->email,
            'password' => 'password',
        ]));
    }
}
