<?php

namespace Database\Factories;

use App\Models\Athlete;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class AthleteFactory extends Factory
{
    protected $model = Athlete::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'group_id' => 1,  // Relacionado ao grupo
            'responsible_name' => $this->faker->name(),
            'responsible_CPF' => $this->faker->unique()->numerify('###########'), // CPF sem pontuação
            'responsible_email' => $this->faker->unique()->safeEmail(),
            'responsible_phone' => $this->faker->phoneNumber(),
            'cpf' => $this->faker->unique()->numerify('###########'), // CPF sem pontuação
            'height' => $this->faker->randomFloat(2, 1.50, 2.00), // Altura entre 1.50m e 2.00m
            'weight' => $this->faker->randomFloat(2, 50, 100), // Peso entre 50kg e 100kg
            'birth_date' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['male', 'female', 'others']),
            'cep' => $this->faker->postcode(),
            'street' => $this->faker->streetName(),
            'number' => $this->faker->buildingNumber(),
            'complement' => $this->faker->optional()->secondaryAddress(),
            'neighborhood' => $this->faker->citySuffix(),
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(),
        ];
    }
}
