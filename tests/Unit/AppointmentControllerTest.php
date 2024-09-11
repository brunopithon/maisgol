<?php

namespace Tests\Unit;

use App\Models\Field;
use App\Models\Coach;
use App\Models\Group;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_appointment_if_field_and_coach_are_available()
    {
        // Criar um campo, treinador e grupo com disponibilidade
        $field = Field::factory()->create([
        ]);

        $coach = Coach::factory()->create([
        ]);

        $group = Group::factory()->create();

        // Dados de exemplo para criar um agendamento
        $appointmentData = [
            'field_id' => $field->id,
            'coach_id' => $coach->id,
            'group_id' => $group->id,
            'day' => 'monday',
            'start_time' => '10:00:00',
        ];

        $response = $this->postJson('/api/appointment', $appointmentData);

        $response->assertStatus(201);
        $response->assertJson([
            'message' => 'Agendamento criado com sucesso.',
            'data' => [
                'field_id' => $field->id,
                'coach_id' => $coach->id,
                'group_id' => $group->id,
                'day' => 'monday',
                'start_time' => '10:00:00',
            ],
        ]);

        // Verificar se o agendamento foi salvo no banco de dados
        $this->assertDatabaseHas('appointments', $appointmentData);

        // Verificar se o horário do campo e do treinador foi atualizado
        $field->refresh();
        $coach->refresh();
        $this->assertFalse(json_decode($field->timetable, true)['monday'][10]);
        $this->assertFalse(json_decode($coach->timetable, true)['monday'][10]);
    }

    public function it_returns_error_if_field_is_not_available()
    {
        $field = Field::factory()->create([
            'timetable' => json_encode([
                'monday' => [10 => false], // Campo indisponível
            ]),
        ]);

        $coach = Coach::factory()->create([
            'timetable' => json_encode([
                'monday' => [10 => true], // Treinador disponível
            ]),
        ]);

        $group = Group::factory()->create();

        $appointmentData = [
            'field_id' => $field->id,
            'coach_id' => $coach->id,
            'group_id' => $group->id,
            'day' => 'monday',
            'start_time' => '10:00:00',
        ];

        $response = $this->postJson('/api/appointment', $appointmentData);

        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'O campo não está disponível no horário selecionado para o dia escolhido.',
        ]);

        $this->assertDatabaseMissing('appointments', $appointmentData);
    }

    /** @test */
    public function it_returns_error_if_coach_is_not_available()
    {
        $field = Field::factory()->create([
            'timetable' => json_encode([
                'monday' => [10 => true], // Campo disponível
            ]),
        ]);

        $coach = Coach::factory()->create([
            'timetable' => json_encode([
                'monday' => [10 => false], // Treinador indisponível
            ]),
        ]);

        $group = Group::factory()->create();

        $appointmentData = [
            'field_id' => $field->id,
            'coach_id' => $coach->id,
            'group_id' => $group->id,
            'day' => 'monday',
            'start_time' => '10:00:00',
        ];

        $response = $this->postJson('/api/appointment', $appointmentData);

        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'O treinador não está disponível no horário selecionado para o dia escolhido.',
        ]);

        $this->assertDatabaseMissing('appointments', $appointmentData);
    }




}
