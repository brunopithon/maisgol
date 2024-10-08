<?php

namespace Database\Factories;

use App\Models\Coach;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CoachFactory extends Factory
{
    /**
     * O nome do modelo correspondente.
     *
     * @var string
     */
    protected $model = Coach::class;

    /**
     * Definir o estado padrão do modelo.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'cpf' => $this->faker->unique()->numerify('###########'),
            'status' => $this->faker->randomElement(['active']),
            'birth_date' => $this->faker->date(),
            'email' => $this->faker->unique()->safeEmail(),
            'timetable' => '{"monday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"tuesday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"wednesday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"thursday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"friday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"saturday":{"9":false,"10":false,"11":false,"13":false,"14":false,"15":false},"sunday":{"9":false,"10":false,"11":false,"13":false,"14":false,"15":false}}',
        ];
    }
}
