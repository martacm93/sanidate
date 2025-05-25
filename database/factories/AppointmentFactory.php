<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // Random doctor and patient — make sure these exist!
            'doctor_id' => Doctor::inRandomOrder()->value('id'),
            'patient_id' => Patient::inRandomOrder()->value('id'),

            // 1 to 3 hours per consultation
            'consultation_hours' => $this->faker->numberBetween(1, 3),

            // Date in the next 30 days
            'appointment_date' => $this->faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),

            // Time between 08:00 and 17:00
            'appointment_time' => $this->faker->time('H:i'),

            // Status flags (0 = pending, 1 = confirmed)
            'patient_status' => $this->faker->numberBetween(0, 1),
            'doctor_status' => $this->faker->numberBetween(0, 1),

            'active' => true,
        ];
    }
}

