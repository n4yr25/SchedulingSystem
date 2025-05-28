<?php

namespace Database\Seeders;

use Database\Seeders\AcademicProgramSeeder;
use Database\Seeders\CurriculaSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\RoomSeeder;
use Database\Seeders\SectionSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(AcademicProgramSeeder::class);
        $this->call(CurriculaSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(RoomSeeder::class);
    }
}
