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
            'abbreviation' => 'lu'
        ]);

        Weekdays::create([
            'name' => 'martes',
            'abbreviation' => 'ma'
        ]);

        Weekdays::create([
            'name' => 'miercoles',
            'abbreviation' => 'mi'
        ]);

        Weekdays::create([
            'name' => 'jueves',
            'abbreviation' => 'ju'
        ]);

        Weekdays::create([
            'name' => 'viernes',
            'abbreviation' => 'vi'
        ]);

        Weekdays::create([
            'name' => 'sabado',
            'abbreviation' => 'sa'
        ]);
    }
}
