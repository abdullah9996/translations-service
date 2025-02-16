<?php

namespace App\Console\Commands;

use App\Models\Translation;
use Database\Factories\UserFactory;
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
        $numChunks = ceil($count / $chunkSize);

        $this->info("Seeding {$count} users...");

        // Initialize the UserFactory
        $userFactory = new UserFactory();

        for ($i = 0; $i < $numChunks; $i++) {
            // Generate a chunk of user records
            $users = $this->generateUsers($userFactory, $chunkSize);

            // Insert the chunk into the database
            DB::table('users')->insert($users);

            $this->info("Inserted " . (($i + 1) * $chunkSize) . " records...");
        }

        $this->info("✅ Seeding completed!");
    }

    /**
     * Generate fake users data using UserFactory.
     */
    protected function generateUsers(UserFactory $userFactory, $count)
    {
        $users = [];

        for ($i = 0; $i < $count; $i++) {
            $users[] = $userFactory->definition();
        }

        return $users;
    }
}
