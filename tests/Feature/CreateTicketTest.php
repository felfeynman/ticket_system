<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTicketTest extends TestCase
{
    use RefreshDatabase;

    public function test_ticket_is_created_with_default_status()
    {
        $category = Category::factory()->create();

        $response = $this->postJson('/api/tickets', [
            'title' => 'Teste',
            'description' => 'Descrição teste',
            'category_id' => $category->id
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('tickets', [
            'title' => 'Teste',
            'status' => 'open'
        ]);
    }
}
