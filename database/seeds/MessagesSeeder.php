<?php

use App\Message;
use Illuminate\Database\Seeder;

class MessagesSeeder extends Seeder
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
        $victor = \App\User::where('name', 'Victor')->first();
        $bryan = \App\User::where('name', 'Bryan')->first();

        $this->makeMessage('Vous avez vu le dernier Avenger ?', $film, $victor);
        $this->makeMessage('Non j\'y vais mardi ! pas de spoils !', $film, $nico);
        $this->makeMessage('Comment ca se fait ??', $film, $victor);
        $this->makeMessage('J\'ai du recodé slack !', $film, $nico);

        $this->makeMessage('Quelqu\'un a un morceau stylé a me conseillé ?', $music, $bryan);
        $this->makeMessage('Quel genre?', $music, $nico);
        $this->makeMessage('Hum ...', $music, $bryan);
        $this->makeMessage('Rap/Electro ?', $music, $bryan);
        $this->makeMessage('Ecoute Alltta sur Spotify !', $music, $nico);
    }

    public function makeMessage($text, $room, $user){
        $message = new Message();
        $message->text = $text;
        $message->room()->associate($room);
        $message->user()->associate($user);
        $message->save();
    }
}
