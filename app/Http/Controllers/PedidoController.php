<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;
use App\Models\Pedido;
use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Pedidos",
 *     description="Operaciones relacionadas con los pedidos"
 * )
 */

/**
 * @OA\Schema(
 *     schema="Pedido",
 *     type="object",
 *     required={"usuario_id", "mesa_id", "estado"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="usuario_id", type="integer", example=1),
 *     @OA\Property(property="mesa_id", type="integer", example=2),
 *     @OA\Property(property="estado", type="string", example="pendiente"),
 *     @OA\Property(property="notas", type="string", example="Sin cebolla"),
 *     @OA\Property(property="numero_pedido", type="string", example="PED12345"),
 *     @OA\Property(property="monto_total", type="number", format="float", example=150.75),
 *     @OA\Property(property="metodo_pago", type="string", example="tarjeta"),
 *     @OA\Property(property="estado_pago", type="string", example="pagado"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class PedidoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/pedidos",
     *     summary="Obtener lista de pedidos",
     *     tags={"Pedidos"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista completa de pedidos",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Pedido"))
     *     )
     * )
     */
    public function index()
    {
        $pedidos = Pedido::all();
        return response()->json($pedidos, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/pedidos",
     *     summary="Crear un nuevo pedido",
     *     tags={"Pedidos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"usuario_id", "mesa_id", "estado"},
     *             @OA\Property(property="usuario_id", type="integer", example=1),
     *             @OA\Property(property="mesa_id", type="integer", example=2),
     *             @OA\Property(property="estado", type="string", example="pendiente"),
     *             @OA\Property(property="notas", type="string", example="Sin cebolla"),
     *             @OA\Property(property="numero_pedido", type="string", example="PED12345"),
     *             @OA\Property(property="monto_total", type="number", format="float", example=150.75),
     *             @OA\Property(property="metodo_pago", type="string", example="tarjeta"),
     *             @OA\Property(property="estado_pago", type="string", example="pendiente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Pedido creado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Pedido")
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
            'estado' => 'required|string|in:pendiente,preparando,completado,cancelado',
            'notas' => 'nullable|string|max:255',
            'numero_pedido' => 'required|string|unique:pedidos,numero_pedido',
            'monto_total' => 'required|numeric|min:0',
            'metodo_pago' => 'nullable|string|in:efectivo,tarjeta,transferencia,otro',
            'estado_pago' => 'nullable|string|in:pendiente,pagado,cancelado',
        ]);

        $pedido = Pedido::create($request->all());

        return response()->json($pedido, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/pedidos/{id}",
     *     summary="Obtener un pedido por ID",
     *     tags={"Pedidos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del pedido",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles del pedido",
     *         @OA\JsonContent(ref="#/components/schemas/Pedido")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pedido no encontrado"
     *     )
     * )
     */
    public function show(Pedido $pedido)
    {
        return response()->json($pedido, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/pedidos/{id}",
     *     summary="Actualizar un pedido existente",
     *     tags={"Pedidos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del pedido",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="usuario_id", type="integer", example=1),
     *             @OA\Property(property="mesa_id", type="integer", example=2),
     *             @OA\Property(property="estado", type="string", example="preparando"),
     *             @OA\Property(property="notas", type="string", example="Sin cebolla"),
     *             @OA\Property(property="numero_pedido", type="string", example="PED12345"),
     *             @OA\Property(property="monto_total", type="number", format="float", example=150.75),
     *             @OA\Property(property="metodo_pago", type="string", example="tarjeta"),
     *             @OA\Property(property="estado_pago", type="string", example="pendiente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pedido actualizado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Pedido")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pedido no encontrado"
     *     )
     * )
     */
    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'mesa_id' => 'required|exists:mesas,id',
            'estado' => 'required|string|in:pendiente,preparando,completado,cancelado',
            'notas' => 'nullable|string|max:255',
            'numero_pedido' => 'required|string|unique:pedidos,numero_pedido,' . $pedido->id,
            'monto_total' => 'required|numeric|min:0',
            'metodo_pago' => 'nullable|string|in:efectivo,tarjeta,transferencia,otro',
            'estado_pago' => 'nullable|string|in:pendiente,pagado,cancelado',
        ]);

        $pedido->update($request->all());

        return response()->json($pedido, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/pedidos/{id}",
     *     summary="Eliminar un pedido",
     *     tags={"Pedidos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del pedido",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Pedido eliminado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pedido no encontrado"
     *     )
     * )
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return response()->json(['message' => 'Pedido eliminado correctamente'], 204);
    }
}
