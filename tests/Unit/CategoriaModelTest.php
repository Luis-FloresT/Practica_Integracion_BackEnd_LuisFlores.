<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriaModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test: Verificar que una categoría puede tener productos
     */
    public function test_categoria_puede_tener_productos(): void
    {
        // 1. Crear una categoría
        $categoria = Categoria::create([
            'nombre' => 'Electrónica',
            'descripcion' => 'Productos electrónicos',
            'activa' => true,
        ]);

        // 2. Crear productos asociados a esa categoría
        Producto::create([
            'categoria_id' => $categoria->id,
            'nombre' => 'Laptop',
            'sku' => 'LAP-001',
            'stock' => 10,
            'precio' => 999.99,
            'activo' => true,
        ]);

        Producto::create([
            'categoria_id' => $categoria->id,
            'nombre' => 'Mouse',
            'sku' => 'MOU-001',
            'stock' => 50,
            'precio' => 25.99,
            'activo' => true,
        ]);

        // 3. Verificar que la categoría tiene 2 productos
        $this->assertCount(2, $categoria->productos);
    }

    /**
     * Test: Consultar todos los productos de una categoría
     */
    public function test_consultar_productos_de_una_categoria(): void
    {
        // 1. Crear categoría
        $categoria = Categoria::create([
            'nombre' => 'Ropa',
            'descripcion' => 'Prendas de vestir',
            'activa' => true,
        ]);

        // 2. Crear productos
        Producto::create([
            'categoria_id' => $categoria->id,
            'nombre' => 'Camisa',
            'sku' => 'CAM-001',
            'stock' => 20,
            'precio' => 29.99,
            'activo' => true,
        ]);

        // 3. Obtener productos de la categoría
        $productos = $categoria->productos;

        // 4. Verificar que hay 1 producto y es "Camisa"
        $this->assertCount(1, $productos);
        $this->assertEquals('Camisa', $productos->first()->nombre);
    }

    /**
     * Test: Verificar que el nombre de categoría es obligatorio
     */
    public function test_nombre_categoria_es_obligatorio(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Categoria::create([
            'descripcion' => 'Sin nombre',
            'activa' => true,
        ]);
    }
}