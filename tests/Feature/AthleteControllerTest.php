<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Group; // Adicione a importação do model Group
use App\Models\Athlete;

class AthleteControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa a criação de um atleta.
     *
     * @return void
     */
    public function test_can_create_athlete()
    {

        $group = Group::factory()->create();

        $data = [
            'name' => 'Dr. Antonieta Vila Zambrano',
            'group_id' => $group->id,
            'responsible_name' => 'Sra. Katherine Ketlin Guerra',
            'responsible_CPF' => '46747158786',
            'responsible_email' => 'zrodrigues@example.net',
            'responsible_phone' => '(42) 2132-4099',
            'cpf' => '97999881931',
            'height' => 1.73,
            'weight' => 54.14,
            'birth_date' => '1978-02-05',
            'gender' => 'male',
            'cep' => '22618-881',
            'street' => 'Av. Laís Burgos',
            'number' => '63208',
            'complement' => '?',
            'neighborhood' => 'do Leste',
            'city' => 'Porto Estela',
            'state' => 'AL',
        ];


        $response = $this->postJson('/api/athlete', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('athletes', [
            'name' => $data['name'],
            'group_id' => $data['group_id'],
            'responsible_CPF' => $data['responsible_CPF'],
        ]);
    }

    /**
     * Testa a listagem de atletas.
     *
     * @return void
     */
    public function can_list_athletes()
    {
        $group = Group::factory()->create();

        $athlete = Athlete::factory()->create([
            'name' => 'Dr. Antonieta Vila Zambrano',
            'group_id' => $group->id,
        ]);

        $response = $this->getJson('/api/athletes');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'name' => 'Dr. Antonieta Vila Zambrano',
        ]);
    }

    /**
     * Testa a visualização de um atleta específico.
     *
     * @return void
     */
    public function test_can_show_single_athlete()
    {
        $group = Group::factory()->create();
        $athlete = Athlete::factory()->create(['group_id' => $group->id]);

        $response = $this->getJson('/api/athlete/' . $athlete->id);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'name' => $athlete->name,
        ]);
    }

    /**
     * Testa a atualização de um atleta.
     *
     * @return void
     */
    public function test_can_update_athlete()
    {
        $group = Group::factory()->create();
        $athlete = Athlete::factory()->create(['group_id' => $group->id]);

        $data = [
            'name' => 'Dr. Franco das Dores',
            'group_id' => $group->id,
            'responsible_name' => 'Sra. Luzia Abreu Santos',
            'responsible_CPF' => '57692718965',
            'responsible_email' => 'giovane95@example.com',
            'responsible_phone' => '(63) 97996-6085',
            'cpf' => '73984248933',
            'height' => 2,
            'weight' => 91.53,
            'birth_date' => '1991-06-26',
            'gender' => 'others',
            'cep' => '81846-710',
            'street' => 'Avenida Márcia',
            'number' => '417',
            'complement' => 'Apto 65',
            'neighborhood' => 'd\'Oeste',
            'city' => 'São Ariana d\'Oeste',
            'state' => 'AP',
        ];

        $response = $this->putJson('/api/athlete/' . $athlete->id, $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('athletes', [
            'id' => $athlete->id,
            'name' => $data['name'],
        ]);
    }

}
