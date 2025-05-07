<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;
use App\Models\Turno;
use App\Http\Requests\StoreTurnoRequest;
use App\Http\Requests\UpdateTurnoRequest;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Turnos",
 *     description="Operaciones relacionadas con los turnos"
 * )
 */

/**
 * @OA\Schema(
 *     schema="Turno",
 *     type="object",
 *     required={"usuario_id", "hora_inicio", "hora_fin"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="usuario_id", type="integer", example=1),
 *     @OA\Property(property="hora_inicio", type="string", format="time", example="08:00"),
 *     @OA\Property(property="hora_fin", type="string", format="time", example="16:00"),
 *     @OA\Property(property="notas", type="string", example="Turno de mañana"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class TurnoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/turnos",
     *     summary="Obtener lista de turnos",
     *     tags={"Turnos"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista completa de turnos",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Turno"))
     *     )
     * )
     */
    public function index()
    {
        $turnos = Turno::all();
        return response()->json($turnos, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/turnos",
     *     summary="Crear un nuevo turno",
     *     tags={"Turnos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"usuario_id", "hora_inicio", "hora_fin"},
     *             @OA\Property(property="usuario_id", type="integer", example=1),
     *             @OA\Property(property="hora_inicio", type="string", format="time", example="08:00"),
     *             @OA\Property(property="hora_fin", type="string", format="time", example="16:00"),
     *             @OA\Property(property="notas", type="string", example="Turno de mañana")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Turno creado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Turno")
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
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'notas' => 'nullable|string|max:255',
        ]);

        $turno = Turno::create($request->all());

        return response()->json($turno, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/turnos/{id}",
     *     summary="Obtener un turno por ID",
     *     tags={"Turnos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del turno",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles del turno",
     *         @OA\JsonContent(ref="#/components/schemas/Turno")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Turno no encontrado"
     *     )
     * )
     */
    public function show(Turno $turno)
    {
        return response()->json($turno, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/turnos/{id}",
     *     summary="Actualizar un turno existente",
     *     tags={"Turnos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del turno",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="usuario_id", type="integer", example=1),
     *             @OA\Property(property="hora_inicio", type="string", format="time", example="08:00"),
     *             @OA\Property(property="hora_fin", type="string", format="time", example="16:00"),
     *             @OA\Property(property="notas", type="string", example="Turno de mañana")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Turno actualizado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Turno")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Turno no encontrado"
     *     )
     * )
     */
    public function update(Request $request, Turno $turno)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'notas' => 'nullable|string|max:255',
        ]);

        $turno->update($request->all());

        return response()->json($turno, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/turnos/{id}",
     *     summary="Eliminar un turno",
     *     tags={"Turnos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del turno",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Turno eliminado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Turno no encontrado"
     *     )
     * )
     */
    public function destroy(Turno $turno)
    {
        $turno->delete();

        return response()->json(['message' => 'Turno eliminado correctamente'], 204);
    }
}
