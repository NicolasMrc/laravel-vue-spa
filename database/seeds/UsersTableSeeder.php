<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      =>  'Julian',
            'email'     =>  'julian@vendredi.cc',
            'password'  =>  bcrypt('julian')
        ]);

        User::create([
            'name'      =>  'Nico',
            'email'     =>  'dev@nicolasmercier.io',
            'password'  =>  bcrypt('nicolas')
        ]);

        User::create([
            'name'      =>  'Damien',
            'email'     =>  'damien@neiwad.io',
            'password'  =>  bcrypt('damien')
        ]);

        User::create([
            'name'      =>  'Victor',
            'email'     =>  'victor@mx.io',
            'password'  =>  bcrypt('victor')
        ]);

        User::create([
            'name'      =>  'Bryan',
            'email'     =>  'bryan@boumboumbam.io',
            'password'  =>  bcrypt('bryan')
        ]);
    }
}
