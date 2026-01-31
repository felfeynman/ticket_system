<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_cannot_delete_category_with_tickets()
    {
        // cria categoria
        $category = Category::factory()->create();

        // cria ticket associado
        Ticket::factory()->create([
            'category_id' => $category->id
        ]);

        // tenta deletar
        $response = $this->deleteJson("/api/categories/{$category->id}");

        // verifica erro
        $response->assertStatus(422);

        // garante que ainda existe
        $this->assertDatabaseHas('categories', [
            'id' => $category->id
        ]);
    }
}
