<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\CtrRoom::create([
            'room' => '303',
            'building' => 'IT Building'
        ]);

        \App\CtrRoom::create([
            'room' => '302',
            'building' => 'IT Building'
        ]);

        \App\CtrRoom::create([
            'room' => '301',
            'building' => 'IT Building'
        ]);
    }
}
