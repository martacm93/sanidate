<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialty;

class SpecialtiesTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
            'General Medicine',
            'Cardiology',
            'Dermatology',
            'Endocrinology',
            'Gastroenterology',
            'Neurology',
            'Pediatrics',
            'Psychiatry',
            'Orthopedics',
            'Pulmonology',
            'Oncology',
            'Ophthalmology',
            'Rheumatology',
            'Urology',
            'Infectious Diseases',
        ];

        foreach ($specialties as $specialty) {
            Specialty::firstOrCreate(
                ['name' => $specialty],
                ['active' => true]
            );
        }
    }
}
