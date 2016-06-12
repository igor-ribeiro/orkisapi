<?php

use OrkisApp\Models\User;
use OrkisApp\Models\Nursery;
use OrkisApp\Models\Orchid;
use Faker\Provider\pt_BR\Person;
use Faker\Provider\pt_BR\Company;
use Faker\Provider\pt_BR\Address;

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

$factory->define(Orchid::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Address($faker));

    $name = $faker->name;
    $hash = base_convert(md5($name . date('ymdhis')), 10, 36);

    return [
        'name' => $name,
        'scientific_name' => $name,
        'image' => 'http://placehold.it/450x450',
        'hash' => $hash,
        'origin' => $faker->country,
        'description' => $faker->realText(200, 2),
        'instructions' => $faker->realText(200, 2),
    ];
});
