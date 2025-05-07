<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;
use App\Models\ItemPedido;
use App\Http\Requests\StoreItemPedidoRequest;
use App\Http\Requests\UpdateItemPedidoRequest;
use Illuminate\Http\Request;


/**
 * @OA\Tag(
 *     name="Ítems de Pedido",
 *     description="Operaciones relacionadas con los ítems de pedidos"
 * )
 */

/**
 * @OA\Schema(
 *     schema="ItemPedido",
 *     type="object",
 *     required={"pedido_id", "producto_id", "cantidad", "precio_unitario"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="pedido_id", type="integer", example=1),
 *     @OA\Property(property="producto_id", type="integer", example=2),
 *     @OA\Property(property="cantidad", type="integer", example=3),
 *     @OA\Property(property="precio_unitario", type="number", format="float", example=12.50),
 *     @OA\Property(property="precio_total", type="number", format="float", example=37.50),
 *     @OA\Property(property="solicitudes_especiales", type="string", example="Sin azúcar"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class ItemPedidoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/item_pedidos",
     *     summary="Obtener lista de ítems de pedidos",
     *     tags={"Ítems de Pedido"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista completa de ítems de pedidos",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/ItemPedido"))
     *     )
     * )
     */
    public function index()
    {
        $itemsPedido = ItemPedido::all();
        return response()->json($itemsPedido, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/item_pedidos",
     *     summary="Crear un nuevo ítem de pedido",
     *     tags={"Ítems de Pedido"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"pedido_id", "producto_id", "cantidad", "precio_unitario"},
     *             @OA\Property(property="pedido_id", type="integer", example=1),
     *             @OA\Property(property="producto_id", type="integer", example=2),
     *             @OA\Property(property="cantidad", type="integer", example=3),
     *             @OA\Property(property="precio_unitario", type="number", format="float", example=12.50),
     *             @OA\Property(property="solicitudes_especiales", type="string", example="Sin azúcar")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Ítem de pedido creado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/ItemPedido")
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
            'pedido_id' => 'required|exists:pedidos,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'solicitudes_especiales' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['precio_total'] = $data['cantidad'] * $data['precio_unitario'];

        $itemPedido = ItemPedido::create($data);

        return response()->json($itemPedido, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/item_pedidos/{id}",
     *     summary="Obtener un ítem de pedido por ID",
     *     tags={"Ítems de Pedido"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del ítem de pedido",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles del ítem de pedido",
     *         @OA\JsonContent(ref="#/components/schemas/ItemPedido")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ítem de pedido no encontrado"
     *     )
     * )
     */
    public function show(ItemPedido $itemPedido)
    {
        return response()->json($itemPedido, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/item_pedidos/{id}",
     *     summary="Actualizar un ítem de pedido existente",
     *     tags={"Ítems de Pedido"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del ítem de pedido",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="pedido_id", type="integer", example=1),
     *             @OA\Property(property="producto_id", type="integer", example=2),
     *             @OA\Property(property="cantidad", type="integer", example=3),
     *             @OA\Property(property="precio_unitario", type="number", format="float", example=12.50),
     *             @OA\Property(property="solicitudes_especiales", type="string", example="Sin azúcar")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ítem de pedido actualizado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/ItemPedido")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ítem de pedido no encontrado"
     *     )
     * )
     */
    public function update(Request $request, ItemPedido $itemPedido)
    {
        $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'solicitudes_especiales' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['precio_total'] = $data['cantidad'] * $data['precio_unitario'];

        $itemPedido->update($data);

        return response()->json($itemPedido, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/item_pedidos/{id}",
     *     summary="Eliminar un ítem de pedido",
     *     tags={"Ítems de Pedido"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del ítem de pedido",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Ítem de pedido eliminado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ítem de pedido no encontrado"
     *     )
     * )
     */
    public function destroy(ItemPedido $itemPedido)
    {
        $itemPedido->delete();

        return response()->json(['message' => 'Ítem de pedido eliminado correctamente'], 204);
    }
}
