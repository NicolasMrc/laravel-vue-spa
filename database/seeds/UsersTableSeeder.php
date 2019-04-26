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
            'name'      =>  'Root',
            'email'     =>  'root@example.com',
            'password'  =>  bcrypt('root')
        ]);

        User::create([
            'name'      =>  'Nico',
            'email'     =>  'dev@nicolasmercier.io',
            'password'  =>  bcrypt('root')
        ]);
    }
}
