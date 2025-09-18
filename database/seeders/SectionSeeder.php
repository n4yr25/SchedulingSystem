<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\CtrSection::create([
            'program_code' => 'BSIT',
            'level' => '1st Year',
            'section_name' => 'Block A',
        ]);

        \App\CtrSection::create([
            'program_code' => 'BSIT',
            'level' => '1st Year',
            'section_name' => 'Block B'
        ]);

        \App\CtrSection::create([
            'program_code' => 'BSIT',
            'level' => '2nd Year',
            'section_name' => 'Block A',
        ]);

        \App\CtrSection::create([
            'program_code' => 'BSIT',
            'level' => '2nd Year',
            'section_name' => 'Block B'
        ]);

        \App\CtrSection::create([
            'program_code' => 'BSIT',
            'level' => '3rd Year',
            'section_name' => 'Block A',
        ]);

        \App\CtrSection::create([
            'program_code' => 'BSIT',
            'level' => '3rd Year',
            'section_name' => 'Block B'
        ]);

        \App\CtrSection::create([
            'program_code' => 'BSIT',
            'level' => '4th Year',
            'section_name' => 'Block A',
        ]);

        \App\CtrSection::create([
            'program_code' => 'BSIT',
            'level' => '4th Year',
            'section_name' => 'Block B'
        ]);
    }
}
