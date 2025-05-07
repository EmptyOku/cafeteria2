<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Http\Requests\StoreRecetaRequest;
use App\Http\Requests\UpdateRecetaRequest;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Recetas",
 *     description="Operaciones relacionadas con las recetas"
 * )
 */

/**
 * @OA\Schema(
 *     schema="Receta",
 *     type="object",
 *     required={"producto_id", "insumo_id", "cantidad"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="producto_id", type="integer", example=1),
 *     @OA\Property(property="insumo_id", type="integer", example=2),
 *     @OA\Property(property="cantidad", type="number", format="float", example=2.5),
 *     @OA\Property(property="instrucciones", type="string", example="Mezclar bien antes de usar"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class RecetaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/recetas",
     *     summary="Obtener lista de recetas",
     *     tags={"Recetas"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista completa de recetas",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Receta"))
     *     )
     * )
     */
    public function index()
    {
        $recetas = Receta::all();
        return response()->json($recetas, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/recetas",
     *     summary="Crear una nueva receta",
     *     tags={"Recetas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"producto_id", "insumo_id", "cantidad"},
     *             @OA\Property(property="producto_id", type="integer", example=1),
     *             @OA\Property(property="insumo_id", type="integer", example=2),
     *             @OA\Property(property="cantidad", type="number", format="float", example=2.5),
     *             @OA\Property(property="instrucciones", type="string", example="Mezclar bien antes de usar")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Receta creada exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Receta")
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
            'producto_id' => 'required|exists:productos,id',
            'insumo_id' => 'required|exists:inventario,id',
            'cantidad' => 'required|numeric|min:0',
            'instrucciones' => 'nullable|string|max:500',
        ]);

        $receta = Receta::create($request->all());

        return response()->json($receta, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/recetas/{id}",
     *     summary="Obtener una receta por ID",
     *     tags={"Recetas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la receta",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles de la receta",
     *         @OA\JsonContent(ref="#/components/schemas/Receta")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Receta no encontrada"
     *     )
     * )
     */
    public function show(Receta $receta)
    {
        return response()->json($receta, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/recetas/{id}",
     *     summary="Actualizar una receta existente",
     *     tags={"Recetas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la receta",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="producto_id", type="integer", example=1),
     *             @OA\Property(property="insumo_id", type="integer", example=2),
     *             @OA\Property(property="cantidad", type="number", format="float", example=2.5),
     *             @OA\Property(property="instrucciones", type="string", example="Mezclar bien antes de usar")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Receta actualizada exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Receta")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Receta no encontrada"
     *     )
     * )
     */
    public function update(Request $request, Receta $receta)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'insumo_id' => 'required|exists:inventario,id',
            'cantidad' => 'required|numeric|min:0',
            'instrucciones' => 'nullable|string|max:500',
        ]);

        $receta->update($request->all());

        return response()->json($receta, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/recetas/{id}",
     *     summary="Eliminar una receta",
     *     tags={"Recetas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la receta",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Receta eliminada exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Receta no encontrada"
     *     )
     * )
     */
    public function destroy(Receta $receta)
    {
        $receta->delete();

        return response()->json(['message' => 'Receta eliminada correctamente'], 204);
    }
}
