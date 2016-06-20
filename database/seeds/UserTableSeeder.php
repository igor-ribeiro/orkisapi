<?php

use Carbon\Carbon;
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
                'first_name'       => 'OrkisApp',
                'last_name'        => '',
                'username'         => 'orkisapp',
                'email'            => 'app@orkis.info',
                'password'         => bcrypt('orkisapp@2016'),
                'remember_token'   => str_random(10),
                'token'            => md5('orkisapp@2016'),
                'token_expires_at' => Carbon::now()->addYear(),
            ],
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
            factory(User::class)->create($userData);
        }
    }
}