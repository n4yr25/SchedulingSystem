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
            'program_code' => 'BSED-Math',
            'program_name' => 'Bachelor of Secondary Education Major in Mathematics',
        ]);

        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BSED-English',
            'program_name' => 'Bachelor of Secondary Education Major in English',
        ]);

        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BSED-Science',
            'program_name' => 'Bachelor of Secondary Education Major in Science',
        ]);

        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BEEd-EGE',
            'program_name' => 'Bachelor of Elementary Education Major in Enhanced General Education',
        ]);

        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BTLEd',
            'program_name' => 'Bachelor of Technology and Livelihood Education',
        ]);

        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BSBA-MM',
            'program_name' => 'Bachelor of Science in Business Administration Major in Marketing Management',
        ]);

        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BSBA-FM',
            'program_name' => 'Bachelor of Science in Business Administration Major in Finance Management',
        ]);

        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BIT-Auto',
            'program_name' => 'Bachelor of Industrial Technology Major in Automotive Technology',
        ]);

        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BIT-Electronics',
            'program_name' => 'Bachelor of Industrial Technology Major in Electronics Technology',
        ]);

        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BIT-Electrical',
            'program_name' => 'Bachelor of Industrial Technology Major in Electrical Technology',
        ]);
        
        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BIT-Mechanical',
            'program_name' => 'Bachelor of Industrial Technology Major in Mechanical Technology',
        ]);

        \App\academic_programs::create([
            'academic_type' => 'College',
            'department' => ' ',
            'program_code' => 'BIT-FSM',
            'program_name' => 'Bachelor of Industrial Technology Major in Food Service Management',
        ]);

        // \App\academic_programs::create([
        //     'academic_type' => 'College',
        //     'department' => ' ',
        //     'program_code' => 'BSCS',
        //     'program_name' => 'Bachelor of Science in Computer Science',
        // ]);

        // \App\academic_programs::create([
        //     'academic_type' => 'College',
        //     'department' => ' ',
        //     'program_code' => 'BSCE',
        //     'program_name' => 'Bachelor of Science in Civil Engineering',
        // ]);

        // \App\academic_programs::create([
        //     'academic_type' => 'College',
        //     'department' => ' ',
        //     'program_code' => 'BSME',
        //     'program_name' => 'Bachelor of Science in Mechanical Engineering',
        // ]);

        // \App\academic_programs::create([
        //     'academic_type' => 'College',
        //     'department' => ' ',
        //     'program_code' => 'BSEE',
        //     'program_name' => 'Bachelor of Science in Electrical Engineering',
        // ]);

        // \App\academic_programs::create([
        //     'academic_type' => 'College',
        //     'department' => ' ',
        //     'program_code' => 'BSED',
        //     'program_name' => 'Bachelor in Secondary Education',
        // ]);

        // \App\academic_programs::create([
        //     'academic_type' => 'College',
        //     'department' => ' ',
        //     'program_code' => 'BSCPE',
        //     'program_name' => 'Bachelor of Science in Computer Engineering',
        // ]);
    }
}
