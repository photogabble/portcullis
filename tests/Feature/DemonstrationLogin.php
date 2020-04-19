<?php

namespace Tests\Feature;

use Tests\BootstrapTestCase;

class DemonstrationLogin extends BootstrapTestCase
{

    /**
     * If enabled, visitors can login to a generated user account for the purpose of
     * previewing the service. This generated account will have its delete_after
     * timestamp set to 24 hours from creation and placed within the temporary
     * role. The user can then choose to upgrade to a permanent account by
     * providing registration details such as username/password.
     */
    public function test_demonstration_login()
    {
        $this->markTestIncomplete();
    }

}