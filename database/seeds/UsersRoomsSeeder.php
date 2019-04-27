<?php

use Illuminate\Database\Seeder;

class UsersRoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $film = \App\Room::where('name', 'Films')->first();
        $sport = \App\Room::where('name', 'Sports')->first();
        $music = \App\Room::where('name', 'Music')->first();
        $random = \App\Room::where('name', 'Random')->first();


        $nico = \App\User::where('name', 'Nico')->first();
        $julian = \App\User::where('name', 'Julian')->first();
        $victor = \App\User::where('name', 'Victor')->first();
        $bryan = \App\User::where('name', 'Bryan')->first();

        $nico->rooms()->save($film);
        $nico->rooms()->save($random);
        $nico->rooms()->save($music);

        $julian->rooms()->save($film);
        $julian->rooms()->save($random);
        $julian->rooms()->save($music);

        $victor->rooms()->save($film);
        $victor->rooms()->save($random);
        $victor->rooms()->save($sport);

        $bryan->rooms()->save($film);
        $bryan->rooms()->save($random);
        $bryan->rooms()->save($music);
    }
}
