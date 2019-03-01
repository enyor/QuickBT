<?php
use Illuminate\Support\Facades\Crypt;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstNameMale,
        'last_name' => $faker->lastName,
        'email' => 'user@example.com',
        'password' => Crypt::encrypt('MYPASSWORD'),
        'remember_token' => str_random(10),
        'token' => base64_encode(str_random(40))
    ];
});
