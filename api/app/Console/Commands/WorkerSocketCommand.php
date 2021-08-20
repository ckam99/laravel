<?php

namespace App\Console\Commands;

use App\Services\WebSocket;
use Illuminate\Console\Command;

class WorkerSocketCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'socket {start}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start web socket';

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
    public function handle()
    {
        WebSocket::run();
    }
}
