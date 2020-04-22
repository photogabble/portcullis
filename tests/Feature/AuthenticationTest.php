<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Photogabble\Portcullis\Entities\User;
use Tests\BootstrapTestCase;

class AuthenticationTest extends BootstrapTestCase
{

    use RefreshDatabase;

    public function test_non_disabled_accounts_can_login()
    {
        config()->set('auth.providers.users.model', User::class);

        $this->withoutExceptionHandling();
        /** @var User $user */
        $user = factory(User::class)->create();
        $response = $this->post(route('login'), ['username' => $user->username, 'password' => 'password']);
        $response->assertRedirect(config('registration.home'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_disabled_accounts_cant_login()
    {
        config()->set('auth.providers.users.model', User::class);

        $this->withoutExceptionHandling();
        /** @var User $user */
        $user = factory(User::class)->create(['disabled_on' => Carbon::now()]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);
        $this->post(route('login'), ['username' => $user->username, 'password' => 'password']);
    }

}