<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;
use App\Models\Mesa;
use App\Http\Requests\StoreMesaRequest;
use App\Http\Requests\UpdateMesaRequest;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Mesas",
 *     description="Operaciones relacionadas con las mesas"
 * )
 */

/**
 * @OA\Schema(
 *     schema="Mesa",
 *     type="object",
 *     required={"numero", "capacidad", "estado"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="numero", type="integer", example=1),
 *     @OA\Property(property="capacidad", type="integer", example=4),
 *     @OA\Property(property="estado", type="string", example="disponible"),
 *     @OA\Property(property="ubicacion", type="string", example="Terraza"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class MesaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/mesas",
     *     summary="Obtener lista de mesas",
     *     tags={"Mesas"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista completa de mesas",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Mesa"))
     *     )
     * )
     */
    public function index()
    {
        $mesas = Mesa::all();
        return response()->json($mesas, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/mesas",
     *     summary="Crear una nueva mesa",
     *     tags={"Mesas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"numero", "capacidad", "estado"},
     *             @OA\Property(property="numero", type="integer", example=1),
     *             @OA\Property(property="capacidad", type="integer", example=4),
     *             @OA\Property(property="estado", type="string", example="disponible"),
     *             @OA\Property(property="ubicacion", type="string", example="Terraza")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Mesa creada exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Mesa")
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
            'numero' => 'required|integer|unique:mesas,numero',
            'capacidad' => 'required|integer|min:1',
            'estado' => 'required|string|in:disponible,ocupada,reservada,mantenimiento',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        $mesa = Mesa::create($request->all());

        return response()->json($mesa, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/mesas/{id}",
     *     summary="Obtener una mesa por ID",
     *     tags={"Mesas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la mesa",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles de la mesa",
     *         @OA\JsonContent(ref="#/components/schemas/Mesa")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Mesa no encontrada"
     *     )
     * )
     */
    public function show(Mesa $mesa)
    {
        return response()->json($mesa, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/mesas/{id}",
     *     summary="Actualizar una mesa existente",
     *     tags={"Mesas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la mesa",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="numero", type="integer", example=1),
     *             @OA\Property(property="capacidad", type="integer", example=4),
     *             @OA\Property(property="estado", type="string", example="ocupada"),
     *             @OA\Property(property="ubicacion", type="string", example="Interior")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Mesa actualizada exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Mesa")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Mesa no encontrada"
     *     )
     * )
     */
    public function update(Request $request, Mesa $mesa)
    {
        $request->validate([
            'numero' => 'required|integer|unique:mesas,numero,' . $mesa->id,
            'capacidad' => 'required|integer|min:1',
            'estado' => 'required|string|in:disponible,ocupada,reservada,mantenimiento',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        $mesa->update($request->all());

        return response()->json($mesa, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/mesas/{id}",
     *     summary="Eliminar una mesa",
     *     tags={"Mesas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la mesa",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Mesa eliminada exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Mesa no encontrada"
     *     )
     * )
     */
    public function destroy(Mesa $mesa)
    {
        $mesa->delete();

        return response()->json(['message' => 'Mesa eliminada correctamente'], 204);
    }
}
