<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    /**
     * Seed the appointments table with random appointments
     * between existing doctors and patients using the factory.
     *
     * @return void
     */
   public function run()
{
    // Keep track of used appointment slots to avoid double booking
    $usedSlots = []; // Format: "doctor_id|date|time"

    for ($i = 0; $i < 100; $i++) {
        do {
            // Pick random doctor and patient
            $doctor = Doctor::inRandomOrder()->first();
            $patient = Patient::inRandomOrder()->first();

            // Generate random date and time
            $date = fake()->dateTimeBetween('now', '+30 days')->format('Ymd'); 
            $time = fake()->numberBetween(8, 20);

            // Generate unique key to prevent duplicate appointment slots
            $key = $doctor->id . '|' . $date . '|' . $time;

        } while (isset($usedSlots[$key]));

        // Mark this slot as used
        $usedSlots[$key] = true;

        // Create the appointment
        Appointment::create([
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
            'consultation_hours' => fake()->numberBetween(1, 3),
            'appointment_date' => $date,
            'appointment_time' => $time,
            'patient_status' => fake()->numberBetween(0, 1),
            'doctor_status' => fake()->numberBetween(0, 1),
            'active' => true,
        ]);
    }
}

}

