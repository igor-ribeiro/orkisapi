<?php

use OrkisApp\Models\User;
use OrkisApp\Models\Nursery;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name'     => 'Igor',
                'last_name'      => 'Ribeiro',
                'username'       => 'igor-ribeiro',
                'email'          => 'igor@email.com',
                'password'       => bcrypt('igor'),
                'remember_token' => str_random(10),
            ],
        ];

        foreach ($users as $userData) {
            factory(User::class)->create($userData)->each(function ($user) {
                factory(Nursery::class)->create([ 'user_id' => $user->id ]);
            });
        }
    }
}