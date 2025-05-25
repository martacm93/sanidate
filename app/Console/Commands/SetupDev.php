<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupDev extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fresh migration and seed for development environment';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->warn('🌱 Resetting and seeding the development database...');

        // Step 1: Fresh migrate
        $this->call('migrate:fresh');

        // Step 2: Seed
        $this->call('db:seed');

        $this->info('✅ Database has been reset and seeded successfully!');

        // Optional: show user count as a final check
        $users = \App\Models\User::count();
        $doctors = \App\Models\Doctor::count();
        $specialties = \App\Models\Specialty::count();

        $this->line("👤 Users: $users");
        $this->line("🩺 Doctors: $doctors");
        $this->line("🎓 Specialties: $specialties");

        return Command::SUCCESS;
    }
}

