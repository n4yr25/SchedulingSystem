<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurriculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\curriculum::create([
            'curriculum_year' => '2025',
            'program_code' => 'BSIT',
            'program_name' => 'Bachelor of Science in Information Technology',
            'control_code' => 'CC101_IT',
            'course_code' => 'CC101_IT',
            'course_name' => 'Introduction to Computing',
            'lec' => '3',
            'lab' => '3',
            'units' => '3',
            'level' => '1st Year',
            'period' => '1st Semester',
            'is_complab' => '1'
        ]);

        \App\curriculum::create([
            'curriculum_year' => '2025',
            'program_code' => 'BSIT',
            'program_name' => 'Bachelor of Science in Information Technology',
            'control_code' => 'CC102_IT',
            'course_code' => 'CC102_IT',
            'course_name' => 'Fundamentals of Programming',
            'lec' => '3',
            'lab' => '3',
            'units' => '3',
            'level' => '1st Year',
            'period' => '1st Semester',
            'is_complab' => '1'
        ]);

        \App\curriculum::create([
            'curriculum_year' => '2025',
            'program_code' => 'BSIT',
            'program_name' => 'Bachelor of Science in Information Technology',
            'control_code' => 'GE5',
            'course_code' => 'GE5',
            'course_name' => 'The Contemporary World',
            'lec' => '3',
            'lab' => '3',
            'units' => '3',
            'level' => '1st Year',
            'period' => '1st Semester',
            'is_complab' => '1'
        ]);
        
        \App\curriculum::create([
            'curriculum_year' => '2025',
            'program_code' => 'BSIT',
            'program_name' => 'Bachelor of Science in Information Technology',
            'control_code' => 'GE6',
            'course_code' => 'GE6',
            'course_name' => 'Science, Technology and Society',
            'lec' => '3',
            'lab' => '3',
            'units' => '3',
            'level' => '1st Year',
            'period' => '1st Semester',
            'is_complab' => '1'
        ]);

        \App\curriculum::create([
            'curriculum_year' => '2025',
            'program_code' => 'BSIT',
            'program_name' => 'Bachelor of Science in Information Technology',
            'control_code' => 'GE7',
            'course_code' => 'GE7',
            'course_name' => 'Mathematics in the Modern World',
            'lec' => '3',
            'lab' => '3',
            'units' => '3',
            'level' => '1st Year',
            'period' => '1st Semester',
            'is_complab' => '1'
        ]);

        \App\curriculum::create([
            'curriculum_year' => '2025',
            'program_code' => 'BSIT',
            'program_name' => 'Bachelor of Science in Information Technology',
            'control_code' => 'PE1',
            'course_code' => 'PE1',
            'course_name' => 'Physical Activity Towards Health and Fitness 1',
            'lec' => '3',
            'lab' => '3',
            'units' => '3',
            'level' => '1st Year',
            'period' => '1st Semester',
            'is_complab' => '1'
        ]);
    }
}
