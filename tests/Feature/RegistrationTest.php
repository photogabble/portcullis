<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Photogabble\Portcullis\Entities\User;
use Tests\BootstrapTestCase;

class RegistrationTest extends BootstrapTestCase
{
    use RefreshDatabase;

    /**
     * If registration is closed then any attempt to register should be
     * presented with a 403 Forbidden HTTP response.
     */
    public function test_registration_fails_if_closed()
    {
        config()->set('registration.open', false);

        $response = $this->get('/register');
        $response->assertStatus(403);

        $response = $this->post('/register', []);
        $response->assertStatus(403);
    }

    public function test_registration_without_email_password_confirm()
    {
        $this->post(route('register'), factory(User::class)->raw(['email' => null, 'password' => 'password']))
            ->assertRedirect(route('register.password-confirm'));

        $this->from(route('register.password-confirm'))
            ->post(route('register.password-confirm.submit'), [])
            ->assertRedirect(route('register.password-confirm'));

        $this->from(route('register.password-confirm'))
            ->post(route('register.password-confirm.submit'), ['password' => '12345'])
            ->assertRedirect(route('register.password-confirm'));

        $this->post(route('register.password-confirm.submit'), ['password' => 'password'])
            ->assertRedirect(url(config('registration.home')));
    }

    /**
     * If a user is registering via an invite code (even if registration is
     * closed.) It should set the invitee -> inviter relationship.
     */
    public function test_invite_code_sets_user_relationship()
    {
        $this->markTestIncomplete();
    }

    /**
     * If an inviter's account is deleted then any invitees should have
     * the relationship column nulled.
     */
    public function test_invitee_inviter_relationship_nulled_on_account_deletion()
    {
        $this->markTestIncomplete();
    }

}