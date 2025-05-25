<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DoctorUserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->count(10)->doctor()->create();

    }
}

