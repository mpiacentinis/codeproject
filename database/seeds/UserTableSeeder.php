<?php

use Illuminate\Database\Seeder;
use CodeProject\Entities\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        factory( User::class )->create([
            'name' => 'Marinho Piacentinis',
            'email' => 'mpiacentinis@gmail.com',
            'password' => bcrypt(12345),
            'remember_token' => str_random(10),
        ]);
        factory( User::class, 10)->create();
    }
}
