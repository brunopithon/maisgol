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
            'timetable' => json_encode([
                'monday' => $this->faker->time(),
                'wednesday' => $this->faker->time(),
                'friday' => $this->faker->time(),
            ]),
        ];
    }
}
