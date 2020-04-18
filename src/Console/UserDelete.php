<?php

namespace Photogabble\Portcullis\Console;

use Illuminate\Console\Command;

class UserDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:del';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove a user from the system and all their data';

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
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
