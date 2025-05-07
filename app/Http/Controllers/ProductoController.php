<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;
use App\Models\Producto;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Tag(
 *     name="Productos",
 *     description="Operaciones relacionadas con los productos"
 * )
 */

/**
 * @OA\Schema(
 *     schema="Producto",
 *     type="object",
 *     required={"nombre", "precio", "categoria_id"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nombre", type="string", example="Café Latte"),
 *     @OA\Property(property="descripcion", type="string", example="Café con leche espumosa"),
 *     @OA\Property(property="precio", type="number", format="float", example=3.50),
 *     @OA\Property(property="categoria_id", type="integer", example=1),
 *     @OA\Property(property="costo_base", type="number", format="float", example=2.00),
 *     @OA\Property(property="imagen", type="string", example="latte.jpg"),
 *     @OA\Property(property="esta_activo", type="boolean", example=true),
 *     @OA\Property(property="inventario", type="integer", example=50),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class ProductoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/productos",
     *     summary="Obtener lista de productos",
     *     tags={"Productos"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista completa de productos",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Producto"))
     *     )
     * )
     */
    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/productos",
     *     summary="Crear un nuevo producto",
     *     tags={"Productos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "precio", "categoria_id"},
     *             @OA\Property(property="nombre", type="string", example="Café Latte"),
     *             @OA\Property(property="descripcion", type="string", example="Café con leche espumosa"),
     *             @OA\Property(property="precio", type="number", format="float", example=3.50),
     *             @OA\Property(property="categoria_id", type="integer", example=1),
     *             @OA\Property(property="costo_base", type="number", format="float", example=2.00),
     *             @OA\Property(property="imagen", type="string", example="latte.jpg"),
     *             @OA\Property(property="esta_activo", type="boolean", example=true),
     *             @OA\Property(property="inventario", type="integer", example=50)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Producto creado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Producto")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Datos inválidos"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'precio' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'costo_base' => 'nullable|numeric|min:0',
            'imagen' => 'nullable|string|max:255',
            'esta_activo' => 'nullable|boolean',
            'inventario' => 'nullable|integer|min:0',
        ]);

        $producto = Producto::create($request->all());

        return response()->json($producto, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/productos/{id}",
     *     summary="Obtener un producto por ID",
     *     tags={"Productos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del producto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles del producto",
     *         @OA\JsonContent(ref="#/components/schemas/Producto")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Producto no encontrado"
     *     )
     * )
     */
    public function show(Producto $producto)
    {
        return response()->json($producto, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/productos/{id}",
     *     summary="Actualizar un producto existente",
     *     tags={"Productos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del producto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nombre", type="string", example="Café Latte"),
     *             @OA\Property(property="descripcion", type="string", example="Café con leche espumosa"),
     *             @OA\Property(property="precio", type="number", format="float", example=3.50),
     *             @OA\Property(property="categoria_id", type="integer", example=1),
     *             @OA\Property(property="costo_base", type="number", format="float", example=2.00),
     *             @OA\Property(property="imagen", type="string", example="latte.jpg"),
     *             @OA\Property(property="esta_activo", type="boolean", example=true),
     *             @OA\Property(property="inventario", type="integer", example=50)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto actualizado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Producto")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Producto no encontrado"
     *     )
     * )
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'precio' => 'sometimes|numeric|min:0',
            'categoria_id' => 'sometimes|exists:categorias,id',
            'costo_base' => 'nullable|numeric|min:0',
            'imagen' => 'nullable|string|max:255',
            'esta_activo' => 'nullable|boolean',
            'inventario' => 'nullable|integer|min:0',
        ]);

        $producto->update($request->all());

        return response()->json($producto, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/productos/{id}",
     *     summary="Eliminar un producto",
     *     tags={"Productos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del producto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Producto eliminado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Producto no encontrado"
     *     )
     * )
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return response()->json(['message' => 'Producto eliminado correctamente'], 204);
    }
}
