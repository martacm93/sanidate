<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserFactory extends Factory
{
    // Link to the User model
    protected $model = User::class;

    /**
     * Default user attributes
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('sanidate1234'), // default password: 'password'
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ];
    }

    /**
     * Mark user as unverified
     */
    public function unverified()
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Create a user with the 'admin' role
     */
    public function admin()
    {
        return $this->state(fn() => [
            'email' => 'admin@sanidate.com',
            'name' => 'Administrator',
        ])->afterCreating(function (User $user) {
            $role = Role::firstOrCreate(['name' => 'admin']);
            $user->assignRole($role);
        });
    }

    /**
     * Create a user with the 'doctor' role and a related Doctor model
     */
    public function doctor()
    {
        return $this->state(fn() => [
            'email' => 'doctor_' . Str::random(5) . '@sanidate.com',
            'name' => 'Dr. ' . $this->faker->lastName,
        ])->afterCreating(function (User $user) {
            // Assign the role
            $role = Role::firstOrCreate(['name' => 'doctor']);
            $user->assignRole($role);

            // Pick a random specialty from the DB
            $specialtyId = \App\Models\Specialty::inRandomOrder()->value('id');

            // Create the Doctor model linked to this user
            \App\Models\Doctor::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'specialty_id' => $specialtyId,
                    'annual_salary' => fake()->numberBetween(30000, 90000), // realistic salary
                    'active' => true,
                ]
            );
        });
    }


    /**
     * Create a user with the 'patient' role and a related Patient model
     */
    /**
     * Define a user with the 'patient' role and a related Patient model.
     *
     * This creates:
     * - A User with a unique patient-style email
     * - Assigns the 'patient' role via Spatie
     * - Creates the Patient model with medical details
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function patient()
    {
        return $this->state(fn() => [
            // Generate email and name for the patient user
            'email' => 'patient_' . Str::random(5) . '@sanidate.com',
            'name' => 'Patient ' . $this->faker->lastName,
        ])->afterCreating(function (User $user) {
            // Assign the 'patient' role using Spatie
            $role = Role::firstOrCreate(['name' => 'patient']);
            $user->assignRole($role);

            // Create related Patient model with generated attributes
            \App\Models\Patient::firstOrCreate(
                ['user_id' => $user->id],
                [
                    // Random gender: Male or Female
                    'gender' => fake()->randomElement(['Male', 'Female']),
                    // Random age between 0 and 100
                    'age' => fake()->numberBetween(0, 100),
                    // Optional medical warning (nullable)
                    'medical_warnings' => fake()->optional()->sentence(),
                    // Mark patient as active
                    'active' => true,
                ]
            );
        });
    }
}
