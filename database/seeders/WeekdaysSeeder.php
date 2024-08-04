<?php

namespace Database\Seeders;

use App\Models\Weekdays;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeekdaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Weekdays::create([
            'name' => 'lunes',
            'abbreviation' => 'LU'
        ]);

        Weekdays::create([
            'name' => 'martes',
            'abbreviation' => 'MA'
        ]);

        Weekdays::create([
            'name' => 'miercoles',
            'abbreviation' => 'MI'
        ]);

        Weekdays::create([
            'name' => 'jueves',
            'abbreviation' => 'JU'
        ]);

        Weekdays::create([
            'name' => 'viernes',
            'abbreviation' => 'VI'
        ]);

        Weekdays::create([
            'name' => 'sabado',
            'abbreviation' => 'SA'
        ]);
    }
}
