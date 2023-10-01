<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateTravel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:travels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'it automatically generates the trips of each agency';


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
        return Command::SUCCESS;
    }
}
