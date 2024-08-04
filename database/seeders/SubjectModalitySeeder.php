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
            'name' => 'Presencial'
        ]);

        SubjectModality::create([
            'name' => 'Semi Presencial'
        ]);

        SubjectModality::create([
            'name' => 'Virtual o por Internet'
        ]);
    }
}
