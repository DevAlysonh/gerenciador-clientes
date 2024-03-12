<?php

namespace Database\Factories\Client;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
			'social_name' => fake()->name(),
			'birthdate' => fake()->date(),
			'document' => fake()->numerify('###########'),
			'type' => 'individual' // individual = pessoa física, company = pessoa jurídica
        ];
    }
}
