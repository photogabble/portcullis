<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Photogabble\Portcullis\Entities\User;
use Symfony\Component\Console\Exception\RuntimeException;
use Tests\BootstrapTestCase;

class AddUserCommandTest extends BootstrapTestCase
{
    use RefreshDatabase;

    public function test_add_user_adds_record()
    {
        // Test add user with email address
        $this->artisan('user:add', ['username' => 'demo', 'email' => 'demo@example.com'])->assertExitCode(0);
        $this->assertDatabaseHas('users', ['username' => 'demo', 'display_name' => 'anonymous', 'email' => 'demo@example.com', 'role' => 'user']);

        // Test add user with email address verified flag set
        $this->artisan('user:add', ['username' => 'demo1', 'email' => 'demo@example.com', '--verified' => true])->assertExitCode(0);
        $found = User::where('username', '=', 'demo1')->first();
        $this->assertNotNull($found->email_verified_at);

        // Test add user without email address
        $this->artisan('user:add', ['username' => 'demo2'])->assertExitCode(0);
        $this->assertDatabaseHas('users', ['username' => 'demo2', 'display_name' => 'anonymous', 'email' => null]);

        // Test adding user with defined role
        $this->artisan('user:add', ['username' => 'demo3', '--role' => 'admin'])->assertExitCode(0);
        $this->assertDatabaseHas('users', ['username' => 'demo3', 'role' => 'admin', 'email' => null]);
    }

    public function test_add_user_validates_input()
    {
        // username is required and must be unique
        $this->expectException(RuntimeException::class);
        $this->artisan('user:add', ['email' => 'demo@example.com'])->assertExitCode(0);

        $this->artisan('user:add', ['username' => 'demo'])->assertExitCode(0);
        $this->artisan('user:add', ['username' => 'demo'])->assertExitCode(1);
    }
}