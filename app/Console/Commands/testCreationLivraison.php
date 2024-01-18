<?php

namespace App\Console\Commands;

use App\Models\Calendriers;
use Illuminate\Console\Command;

class testCreationLivraison extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test-creation-livraison';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Calendriers::generateLivraisons(1, 2023);
    }
}
