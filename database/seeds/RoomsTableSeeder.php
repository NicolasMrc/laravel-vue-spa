<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Room::create([
            'name'      =>  'Random',
        ]);
        \App\Room::create([
            'name'      =>  'Books',
        ]);
        \App\Room::create([
            'name'      =>  'Music',
        ]);
        \App\Room::create([
            'name'      =>  'Animals',
        ]);
        \App\Room::create([
            'name'      =>  'Sports',
        ]);
    }
}
