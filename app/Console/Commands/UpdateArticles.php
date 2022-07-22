<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command update the table articles';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Executing update articles');
    }
}
