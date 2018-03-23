<?php

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
        //
        App\User::create([
             'name' => 'admin',
              'password' => bcrypt('admin'),
             'email'   => 'mahmudul@gmail.com',
             'admin'   => 1,
             'avatar' => asset('avatars/avatar.png')
        ]);

        App\User::create([
            'name' => 'Muhin',
            'password' => bcrypt('admin'),
            'email'   => 'muhin@gmail.com',
            'admin'   => 0,
            'avatar' => asset('avatars/avatar.png')
        ]);



    }
}
