<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Group;

class GroupFactory extends Factory
{
    /**
     * O nome do modelo que esta factory está definindo.
     *
     * @var string
     */
    protected $model = Group::class;

    /**
     * Defina o estado padrão do modelo.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word, // Gera um nome fictício
            'status' => $this->faker->randomElement(['active', 'inactive']), // Gera um status aleatório
        ];
    }
}
