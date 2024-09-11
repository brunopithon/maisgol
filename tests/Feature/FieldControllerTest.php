<?php

namespace Tests\Feature;

use App\Models\Field;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FieldControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_list_fields()
    {
        $field = Field::factory()->create();
        $response = $this->getJson('/api/fields');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $field->name,
        ]);
    }

    /** @test */
    public function can_show_field()
    {
        $field = Field::factory()->create();
        $response = $this->getJson('/api/field/' . $field->id);
        $response->assertStatus(200);
        $response->assertJson([
            'id' => $field->id,
            'name' => $field->name,
        ]);
    }

    /** @test */
    public function can_store_field()
    {
        $data = [
            'name' => 'New Field',
        ];
        $response = $this->postJson('/api/field', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('fields', $data);
    }

    /** @test */
    public function can_update_field()
    {
        $field = Field::factory()->create();
        $data = [
            'name' => 'Updated Field',
        ];
        $response = $this->putJson('/api/field/' . $field->id, $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('fields', [
            'id' => $field->id,
            'name' => 'Updated Field',
        ]);
    }
}
