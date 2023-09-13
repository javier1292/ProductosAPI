<?php

namespace Tests\Feature;

use App\Models\Categorias;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriasTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function testGetAllCategorias()
    {
        $response = $this->get('/api/categorias');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'nombre',
                        'descripcion',

                    ],
                ],
            ]);
    }


    /**
     * @test
     */
    public function testCreateCategoria()
    {
        do {
            $nombre_random = 'categoria ' . rand(1, 1000);
        } while (Categorias::where('nombre', $nombre_random)->exists());
        $data = [
            'nombre' => $nombre_random,
            'descripcion' => 'Descripcion de la categoria 1'
        ];

        $response = $this->post('/api/categorias', $data);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'nombre',
                    'descripcion',
                ],
            ]);

        $this->assertDatabaseHas('categorias', [
            'nombre' => $nombre_random
        ]);
    }

    /**
     * @test
     */
    public function testDeleteCategoria()
    {
        $categoria = Categorias::factory()->create();
        $response = $this->delete("/api/categorias/{$categoria->id}");
        $response->assertStatus(200)
            ->assertJsonStructure([
                'message'
            ]);

            $this->assertSoftDeleted('categorias', [
                'id' => $categoria->id
            ]);

    }
}
