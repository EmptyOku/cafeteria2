<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;
use App\Models\Reserva;
use App\Http\Requests\StoreReservaRequest;
use App\Http\Requests\UpdateReservaRequest;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Reservas",
 *     description="Operaciones relacionadas con las reservas"
 * )
 */

/**
 * @OA\Schema(
 *     schema="Reserva",
 *     type="object",
 *     required={"usuario_id", "mesa_id", "fecha_reservacion", "hora_reservacion", "estado"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="usuario_id", type="integer", example=1),
 *     @OA\Property(property="mesa_id", type="integer", example=2),
 *     @OA\Property(property="fecha_reservacion", type="string", format="date", example="2025-04-23"),
 *     @OA\Property(property="hora_reservacion", type="string", format="time", example="14:00"),
 *     @OA\Property(property="hora_fin", type="string", format="time", example="16:00"),
 *     @OA\Property(property="numero_comensales", type="integer", example=4),
 *     @OA\Property(property="estado", type="string", example="pendiente"),
 *     @OA\Property(property="solicitudes_especiales", type="string", example="Mesa cerca de la ventana"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class ReservaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/reservas",
     *     summary="Obtener lista de reservas",
     *     tags={"Reservas"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista completa de reservas",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Reserva"))
     *     )
     * )
     */
    public function index()
    {
        $reservas = Reserva::all();
        return response()->json($reservas, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/reservas",
     *     summary="Crear una nueva reserva",
     *     tags={"Reservas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"usuario_id", "mesa_id", "fecha_reservacion", "hora_reservacion", "estado"},
     *             @OA\Property(property="usuario_id", type="integer", example=1),
     *             @OA\Property(property="mesa_id", type="integer", example=2),
     *             @OA\Property(property="fecha_reservacion", type="string", format="date", example="2025-04-23"),
     *             @OA\Property(property="hora_reservacion", type="string", format="time", example="14:00"),
     *             @OA\Property(property="hora_fin", type="string", format="time", example="16:00"),
     *             @OA\Property(property="numero_comensales", type="integer", example=4),
     *             @OA\Property(property="estado", type="string", example="pendiente"),
     *             @OA\Property(property="solicitudes_especiales", type="string", example="Mesa cerca de la ventana")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Reserva creada exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Reserva")
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
            'mesa_id' => 'required|exists:mesas,id',
            'fecha_reservacion' => 'required|date',
            'hora_reservacion' => 'required|date_format:H:i',
            'hora_fin' => 'nullable|date_format:H:i|after:hora_reservacion',
            'numero_comensales' => 'required|integer|min:1',
            'estado' => 'required|string|in:pendiente,confirmada,cancelada',
            'solicitudes_especiales' => 'nullable|string|max:255',
        ]);

        $reserva = Reserva::create($request->all());

        return response()->json($reserva, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/reservas/{id}",
     *     summary="Obtener una reserva por ID",
     *     tags={"Reservas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la reserva",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles de la reserva",
     *         @OA\JsonContent(ref="#/components/schemas/Reserva")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Reserva no encontrada"
     *     )
     * )
     */
    public function show(Reserva $reserva)
    {
        return response()->json($reserva, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/reservas/{id}",
     *     summary="Actualizar una reserva existente",
     *     tags={"Reservas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la reserva",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="usuario_id", type="integer", example=1),
     *             @OA\Property(property="mesa_id", type="integer", example=2),
     *             @OA\Property(property="fecha_reservacion", type="string", format="date", example="2025-04-23"),
     *             @OA\Property(property="hora_reservacion", type="string", format="time", example="14:00"),
     *             @OA\Property(property="hora_fin", type="string", format="time", example="16:00"),
     *             @OA\Property(property="numero_comensales", type="integer", example=4),
     *             @OA\Property(property="estado", type="string", example="confirmada"),
     *             @OA\Property(property="solicitudes_especiales", type="string", example="Mesa actualizada")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Reserva actualizada exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Reserva")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Reserva no encontrada"
     *     )
     * )
     */
    public function update(Request $request, Reserva $reserva)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'mesa_id' => 'required|exists:mesas,id',
            'fecha_reservacion' => 'required|date',
            'hora_reservacion' => 'required|date_format:H:i',
            'hora_fin' => 'nullable|date_format:H:i|after:hora_reservacion',
            'numero_comensales' => 'required|integer|min:1',
            'estado' => 'required|string|in:pendiente,confirmada,cancelada',
            'solicitudes_especiales' => 'nullable|string|max:255',
        ]);

        $reserva->update($request->all());

        return response()->json($reserva, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/reservas/{id}",
     *     summary="Eliminar una reserva",
     *     tags={"Reservas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la reserva",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Reserva eliminada exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Reserva no encontrada"
     *     )
     * )
     */
    public function destroy(Reserva $reserva)
    {
        $reserva->delete();

        return response()->json(['message' => 'Reserva eliminada correctamente'], 204);
    }
}
