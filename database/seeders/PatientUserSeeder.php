<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class PatientUserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->count(30)->patient()->create();

    }
}
