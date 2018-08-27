<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ManageUser::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'manage_role_id'      => \App\Models\ManageRole::ROLE_ADMIN,
        'user_last_name'      => 'Test',
        'user_first_name'     => 'test',
    ];
});
