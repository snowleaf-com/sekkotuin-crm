<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      $tel = str_replace('-', '', fake()->phoneNumber());

        return [
            'last_name' => fake()->lastName(),
            'first_name' => fake()->firstName(),
            'last_name_kana' => fake()->lastKanaName(),
            'first_name_kana' => fake()->firstKanaName(),
            'postcode' => fake()->postcode(),
            'address' => implode(' ', [
              fake()->prefecture(),
              fake()->city(),
              fake()->streetAddress(),
            ]),
            'tel' => $tel,
            'birth' => fake()->dateTime(),
            'gender' => fake()->numberBetween(0, 2),
            'memo' => fake()->realText(50),
        ];
    }
}
