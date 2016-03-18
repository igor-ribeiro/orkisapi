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
        factory(User::class, 5)->create()->each(function ($user) {
            factory(Nursery::class)->create([ 'user_id' => $user->id ]);
        });
    }
}
