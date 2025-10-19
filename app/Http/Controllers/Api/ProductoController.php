<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Http\Response;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Producto::query()->with('categoria')->orderBy('id', 'desc')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validacion de datos de entrada
        $data = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:productos,sku',
            'stock' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
            'activo' => 'boolean',
        ]);

    //Crear el registro  en la tabla de la base de datos
    $producto = Producto::create($data);

    //devolver o retornar una respuesta al cliente
    return response()->json($producto, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
        return $producto->load('categoria');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //validacion de datos de entrada
        $data = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:productos,sku,' . $producto->id,
            'stock' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
            'activo' => 'boolean',
        ]);

        //Actualizar el registro en la tabla de la base de datos
        $producto->update($data);

        //devolver o retornar una respuesta al cliente
        return response()->json($producto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
        $producto->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}