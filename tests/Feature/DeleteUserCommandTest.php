<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BootstrapTestCase;

class DeleteUserCommandTest extends BootstrapTestCase
{

    use RefreshDatabase;

    public function test_delete_user_removes_record()
    {
        $this->markTestIncomplete();
    }

}