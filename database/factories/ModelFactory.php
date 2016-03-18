<?php

use OrkisApp\Models\User;
use OrkisApp\Models\Nursery;
use Faker\Provider\pt_BR\Person;
use Faker\Provider\pt_BR\Company;

$factory->define(User::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Person($faker));

    $firstName = $faker->firstName;
    $lastName  = $faker->lastName;
    $username  = str_slug($firstName . '-' . $lastName);
    $email     = str_replace('-', '.', $username) . '@email.com';

    return [
        'first_name'     => $firstName,
        'last_name'      => $lastName,
        'username'       => $username,
        'email'          => $email,
        'password'       => bcrypt('orkisapp'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Nursery::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Company($faker));

    return [
        'name'     => $faker->company,
        'document' => $faker->cnpj(false),
    ];
});
