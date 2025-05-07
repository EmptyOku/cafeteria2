<?php

namespace App\Http\Controllers;

use App\Models\Sesion;
use App\Http\Requests\StoreSesionRequest;
use App\Http\Requests\UpdateSesionRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Sesiones",
 *     description="Operaciones relacionadas con las sesiones"
 * )
 */
class SesionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/sesiones",
     *     summary="Obtener lista de sesiones",
     *     tags={"Sesiones"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista completa de sesiones"
     *     )
     * )
     */
    public function index()
    {
        $sesiones = Sesion::all();
        return response()->json($sesiones, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/sesiones",
     *     summary="Crear una nueva sesión",
     *     tags={"Sesiones"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"usuario_id", "ultima_actividad"},
     *             @OA\Property(property="usuario_id", type="integer", example=1),
     *             @OA\Property(property="agente", type="string", example="Mozilla/5.0"),
     *             @OA\Property(property="ip", type="string", format="ipv4", example="192.168.1.1"),
     *             @OA\Property(property="ultima_actividad", type="string", format="date-time", example="2025-04-23T14:30:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Sesión creada exitosamente"
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
            'usuario_id' => 'required|exists:usuarios,id',
            'agente' => 'nullable|string|max:255',
            'ip' => 'nullable|ip',
            'ultima_actividad' => 'required|date',
        ]);

        $sesion = Sesion::create($request->all());

        return response()->json($sesion, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/sesiones/{id}",
     *     summary="Obtener una sesión por ID",
     *     tags={"Sesiones"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la sesión",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles de la sesión"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Sesión no encontrada"
     *     )
     * )
     */
    public function show(Sesion $sesion)
    {
        return response()->json($sesion, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/sesiones/{id}",
     *     summary="Actualizar una sesión existente",
     *     tags={"Sesiones"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la sesión",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="usuario_id", type="integer", example=1),
     *             @OA\Property(property="agente", type="string", example="Mozilla/5.0"),
     *             @OA\Property(property="ip", type="string", format="ipv4", example="192.168.1.1"),
     *             @OA\Property(property="ultima_actividad", type="string", format="date-time", example="2025-04-23T14:30:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sesión actualizada exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Sesión no encontrada"
     *     )
     * )
     */
    public function update(Request $request, Sesion $sesion)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'agente' => 'nullable|string|max:255',
            'ip' => 'nullable|ip',
            'ultima_actividad' => 'required|date',
        ]);

        $sesion->update($request->all());

        return response()->json($sesion, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/sesiones/{id}",
     *     summary="Eliminar una sesión",
     *     tags={"Sesiones"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la sesión",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Sesión eliminada exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Sesión no encontrada"
     *     )
     * )
     */
    public function destroy(Sesion $sesion)
    {
        $sesion->delete();

        return response()->json(null, 204);
    }
}
