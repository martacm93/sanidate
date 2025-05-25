<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with all required base data.
     *
     * This includes:
     * - Specialties
     * - Users with roles: Admin, Doctors, Patients
     * - Doctors linked to specialties
     * - Patients with demographic info
     * - Appointments between doctors and patients
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // Seed predefined medical specialties
            SpecialtiesTableSeeder::class,

            // Create an admin user with role
            AdminUserSeeder::class,

            // Create doctors with linked user accounts and specialties
            DoctorUserSeeder::class,

            // Create patients with linked user accounts and medical info
            PatientUserSeeder::class,

            // Create appointments between existing doctors and patients
            AppointmentSeeder::class,
        ]);
    }
}