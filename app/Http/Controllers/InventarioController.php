<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;
use App\Models\Inventario;
use App\Http\Requests\StoreInventarioRequest;
use App\Http\Requests\UpdateInventarioRequest;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Inventarios",
 *     description="Operaciones relacionadas con los inventarios"
 * )
 */

/**
 * @OA\Schema(
 *     schema="Inventario",
 *     type="object",
 *     required={"producto", "cantidad", "unidad", "proveedor_id"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="producto", type="string", example="Café en grano"),
 *     @OA\Property(property="cantidad", type="integer", example=100),
 *     @OA\Property(property="unidad", type="string", example="kg"),
 *     @OA\Property(property="proveedor_id", type="integer", example=1),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class InventarioController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/inventarios",
     *     summary="Obtener lista de inventarios",
     *     tags={"Inventarios"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista completa de inventarios",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Inventario"))
     *     )
     * )
     */
    public function index()
    {
        $inventarios = Inventario::all();
        return response()->json($inventarios, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/inventarios",
     *     summary="Crear un nuevo inventario",
     *     tags={"Inventarios"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"producto", "cantidad", "unidad", "proveedor_id"},
     *             @OA\Property(property="producto", type="string", example="Café en grano"),
     *             @OA\Property(property="cantidad", type="integer", example=100),
     *             @OA\Property(property="unidad", type="string", example="kg"),
     *             @OA\Property(property="proveedor_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Inventario creado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Inventario")
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
            'producto' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'cantidad' => 'required|numeric|min:0',
            'unidad' => 'required|string|max:50',
            'nivel_reorden' => 'nullable|numeric|min:0',
            'costo_por_unidad' => 'nullable|numeric|min:0',
            'ubicacion_almacen' => 'nullable|string|max:100',
            'proveedor_id' => 'nullable|exists:proveedores,id',
        ]);

        $inventario = Inventario::create($request->all());

        return response()->json($inventario, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/inventarios/{id}",
     *     summary="Obtener un inventario por ID",
     *     tags={"Inventarios"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del inventario",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles del inventario",
     *         @OA\JsonContent(ref="#/components/schemas/Inventario")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Inventario no encontrado"
     *     )
     * )
     */
    public function show(Inventario $inventario)
    {
        return response()->json($inventario, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/inventarios/{id}",
     *     summary="Actualizar un inventario existente",
     *     tags={"Inventarios"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del inventario",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="producto", type="string", example="Café en grano"),
     *             @OA\Property(property="cantidad", type="integer", example=100),
     *             @OA\Property(property="unidad", type="string", example="kg"),
     *             @OA\Property(property="proveedor_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Inventario actualizado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Inventario")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Inventario no encontrado"
     *     )
     * )
     */
    public function update(Request $request, Inventario $inventario)
    {
        $request->validate([
            'producto' => 'sometimes|string|max:255',
            'cantidad' => 'sometimes|integer|min:0',
            'unidad' => 'sometimes|string|max:50',
            'proveedor_id' => 'sometimes|exists:proveedores,id',
        ]);

        $inventario->update($request->all());

        return response()->json($inventario, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/inventarios/{id}",
     *     summary="Eliminar un inventario",
     *     tags={"Inventarios"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del inventario",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Inventario eliminado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Inventario no encontrado"
     *     )
     * )
     */
    public function destroy(Inventario $inventario)
    {
        $inventario->delete();

        return response()->json(['message' => 'Inventario eliminado correctamente'], 204);
    }
}
