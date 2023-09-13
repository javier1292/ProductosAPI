<?php

namespace Tests\Feature;

use App\Models\Categorias;
use App\Models\Productos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use WithFaker;
    /**
     * @test
     */
    public function testGetAllProducts()
    {
        $response = $this->get('/api/productos');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'nombre',
                        'descripcion',
                        'precio',
                        'categorias' => [
                            '*' => [
                                'id',
                                'nombre',
                                'descripcion',
                            ],
                        ],
                        'fecha_creacion'

                    ],
                ],
            ]);
    }

    /**
     * @test
     */
    public function testGetProductById()
    {
        $producto = Productos::factory()->create();

        $response = $this->get("/api/productos/{$producto->id}");
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'nombre',
                    'descripcion',
                    'precio',
                    'categorias',
                    'fecha_creacion'

                ],
            ]);
    }

    /**
     * @test
     */
    public function testCreateProduct()
    {
        $data = [
            'nombre' => 'Nuevo Producto',
            'descripcion' => 'Descripción del nuevo producto',
            'precio' => 100,
            'categorias' => [1, 2, 3],
        ];
        $response = $this->post('/api/productos', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('productos', [
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'precio' => $data['precio'],
        ]);

    }

    /**
     * @test
     */
    public function testUpdateProduct()
    {
        $producto = Productos::factory()->create();
        $data = [
            'nombre' => 'Nuevo Producto',
            'descripcion' => 'Descripción del nuevo producto',
            'precio' => 100,
            'categorias' => [1, 2, 3],
        ];
        $response = $this->put("/api/productos/{$producto->id}", $data);
        $response->assertStatus(200);

        $this->assertDatabaseHas('productos', [
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'precio' => $data['precio'],
        ]);

    }

    /**
     * @test
     */
    public function testDeleteProduct()
    {
        $producto = Productos::factory()->create();
        $response = $this->delete("/api/productos/{$producto->id}");

        $response->assertStatus(200);

        $this->assertSoftDeleted('productos', ['id' => $producto->id]);
    }
}
