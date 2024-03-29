<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [
    'first_name' => $faker->firstName(),
    'last_name' => $faker->lastName(),
    'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('password_' . $index),
    'email' => $faker->email,
    'phone' => substr($faker->e164PhoneNumber, 1, 11),
    'information' => $faker->realText(300),
    'birthday' => $faker->date(),
    'city_id' => random_int(1, 49),
    'is_executor' =>random_int(0, 1),
];
