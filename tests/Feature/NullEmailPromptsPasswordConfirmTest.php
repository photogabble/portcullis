<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Photogabble\Portcullis\Entities\User;
use Tests\BootstrapTestCase;

class NullEmailPromptsPasswordConfirmTest extends BootstrapTestCase
{
    use RefreshDatabase;

    /**
     * When users register without an email address we make sure that they have confirmed
     * their password. For users whom have registered with an email we don't need to do
     * this as they will be able to reset their password via email.
     */
    public function test_registering_with_no_email_redirects_to_password_confirm()
    {
        $response = $this->post(route('register'), factory(User::class)->raw(['email' => null, 'password' => 'password']));
        $response->assertRedirect(route('register.password-confirm'));

        $this->assertAuthenticated();
    }
}