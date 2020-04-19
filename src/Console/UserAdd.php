<?php

namespace Photogabble\Portcullis\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Photogabble\Portcullis\Entities\User;

class UserAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:add {username} {name?} {email?} {--role=} {--verified}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new user to the system';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $password = Str::random(16);

        $user = new User([
            'username' => $this->argument('username'),
            'name' => $this->argument('name') ?? 'anonymous',
            'email' => $this->argument('email'),
            'role' => $this->option('role') ?? User::ROLE_USER,
            'password' => $password,
        ]);

        if ($this->option('verified')) {
            $user->email_verified_at = Carbon::now();
        }

        if ($user->save()) {
            $this->line('New user created with password <info>'. $password .'</info>');
            return 0;
        }

        return 1;
    }
}
