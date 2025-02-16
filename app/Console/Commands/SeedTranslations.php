<?php

namespace App\Console\Commands;

use App\Models\Translation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SeedTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-translations {count=100000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the translations table with a given number of records';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = (int) $this->argument('count');
        $chunkSize = 1000; // Insert in batches to optimize performance
        $numChunks = ceil($count / $chunkSize );

        $this->info("Seeding {$count} translations...");

        for ($i = 0; $i < $numChunks; $i++) {
            // Create a chunk of records using the factory
            Translation::factory($chunkSize)->create();
            $this->info("Inserted " . ($i * $chunkSize) . " records...");
        }

        $this->info("✅ Seeding completed!");
    }
}
