<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Api\ProductoController;
use Illuminate\Http\Request;

class ProductoApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_producto(): void
    {
        $categoria = Categoria::create([
            'nombre' => 'Tecnología',
            'descripcion' => 'Productos tecnológicos',
            'activa' => true,
        ]);

        $datos = [
            'categoria_id' => $categoria->id,
            'nombre' => 'Teclado Mecánico',
            'sku' => 'TEC-001',
            'stock' => 15,
            'precio' => 89.99,
            'activo' => true,
        ];

        $request = Request::create('/api/guardar-producto', 'POST', $datos);
        $controller = new ProductoController();
        $response = $controller->store($request);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertDatabaseHas('productos', [
            'nombre' => 'Teclado Mecánico',
            'sku' => 'TEC-001',
        ]);
    }

    public function test_consultar_todos_los_productos(): void
{
    $categoria = Categoria::create([
        'nombre' => 'Hogar',
        'descripcion' => 'Productos para el hogar',
        'activa' => true,
    ]);

    Producto::create([
        'categoria_id' => $categoria->id,
        'nombre' => 'Aspiradora',
        'sku' => 'ASP-001',
        'stock' => 5,
        'precio' => 199.99,
        'activo' => true,
    ]);

    Producto::create([
        'categoria_id' => $categoria->id,
        'nombre' => 'Licuadora',
        'sku' => 'LIC-001',
        'stock' => 10,
        'precio' => 79.99,
        'activo' => true,
    ]);

    $controller = new ProductoController();
    $response = $controller->index();

    $this->assertCount(2, $response->items());
}

    public function test_eliminar_producto(): void
    {
        $categoria = Categoria::create([
            'nombre' => 'Deportes',
            'descripcion' => 'Artículos deportivos',
            'activa' => true,
        ]);

        $producto = Producto::create([
            'categoria_id' => $categoria->id,
            'nombre' => 'Pelota',
            'sku' => 'PEL-001',
            'stock' => 30,
            'precio' => 15.99,
            'activo' => true,
        ]);

        $controller = new ProductoController();
        $response = $controller->destroy($producto);

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertDatabaseMissing('productos', [
            'id' => $producto->id,
        ]);
    }

    public function test_no_se_puede_crear_producto_sin_datos_obligatorios(): void
    {
        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $request = Request::create('/api/guardar-producto', 'POST', []);
        $controller = new ProductoController();
        $controller->store($request);
    }
}