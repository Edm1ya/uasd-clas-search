<?php

namespace Database\Seeders;

use App\Models\SubjectModality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubjectModality::create([
            'name' => 'in person'
        ]);

        SubjectModality::create([
            'name' => 'blended'
        ]);

        SubjectModality::create([
            'name' => 'virtual'
        ]);
    }
}
