<?php

namespace Tests\Feature;

use Tests\BootstrapTestCase;

class RegistrationTest extends BootstrapTestCase
{
    /**
     * If registration is closed then any attempt to register should be
     * presented with a 403 Forbidden HTTP response.
     */
    public function test_registration_fails_if_closed ()
    {
        config()->set('registration.open', false);

        $response = $this->get('/register');
        $response->assertStatus(403);

        $response = $this->post('/register', []);
        $response->assertStatus(403);
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