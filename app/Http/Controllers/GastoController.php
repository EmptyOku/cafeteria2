<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;
use App\Models\Gasto;
use App\Http\Requests\StoreGastoRequest;
use App\Http\Requests\UpdateGastoRequest;
use Illuminate\Http\Request;


/**
 * @OA\Tag(
 *     name="Gastos",
 *     description="Operaciones relacionadas con los gastos"
 * )
 */

/**
 * @OA\Schema(
 *     schema="Gasto",
 *     type="object",
 *     required={"usuario_id", "monto", "categoria", "fecha"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="usuario_id", type="integer", example=1),
 *     @OA\Property(property="monto", type="number", format="float", example=150.75),
 *     @OA\Property(property="descripcion", type="string", example="Compra de insumos"),
 *     @OA\Property(property="categoria", type="string", example="Insumos"),
 *     @OA\Property(property="fecha", type="string", format="date", example="2025-05-06"),
 *     @OA\Property(property="comprobante", type="string", example="comprobante.pdf"),
 *     @OA\Property(property="relacion_inventario", type="integer", example=5),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class GastoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/gastos",
     *     summary="Obtener lista de gastos",
     *     tags={"Gastos"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista completa de gastos",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Gasto"))
     *     )
     * )
     */
    public function index()
    {
        $gastos = Gasto::all();
        return response()->json($gastos, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'monto' => 'required|numeric|min:0',
            'categoria' => 'required|string|max:255',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string|max:255',
            'comprobante' => 'nullable|string|max:255',
            'relacion_inventario' => 'nullable|exists:inventario,id',
        ]);

        $gasto = Gasto::create($request->all());

        return response()->json($gasto, 201);
    }


    public function show(Gasto $gasto)
    {
        return response()->json($gasto, 200);
    }


    public function update(Request $request, Gasto $gasto)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'monto' => 'required|numeric|min:0',
            'categoria' => 'required|string|max:255',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string|max:255',
            'comprobante' => 'nullable|string|max:255',
            'relacion_inventario' => 'nullable|exists:inventarios,id',
        ]);

        $gasto->update($request->all());

        return response()->json($gasto, 200);
    }


    public function destroy(Gasto $gasto)
    {
        $gasto->delete();

        return response()->json(['message' => 'Gasto eliminado correctamente'], 204);
    }
}
