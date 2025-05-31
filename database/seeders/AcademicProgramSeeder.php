<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AcademicProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BSIT',
            'program_name' => 'Bachelor of Science in Information Technology',
        ]);

        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BSCS',
            'program_name' => 'Bachelor of Science in Computer Science',
        ]);

        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BSCE',
            'program_name' => 'Bachelor of Science in Civil Engineering',
        ]);

        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BSME',
            'program_name' => 'Bachelor of Science in Mechanical Engineering',
        ]);

        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BSEE',
            'program_name' => 'Bachelor of Science in Electrical Engineering',
        ]);

        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BSED',
            'program_name' => 'Bachelor in Secondary Education',
        ]);

        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BSCPE',
            'program_name' => 'Bachelor of Science in Computer Engineering',
        ]);
    }
}
