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
            'General Odontology',
            'Ortodoncy',
            'Endodoncy',
            'Periodoncy',
            'Stetic Odontology',
            'Odontopediatry',
            'Implantology',
            'Prostodoncy',
        ];

        foreach ($specialties as $specialty) {
            Specialty::create([
                'name' => $specialty,
                'active' => '1'
            ]);
        }
    }
}
