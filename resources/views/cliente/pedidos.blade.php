@extends('layouts.navigation')

@section('content')

<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6 text-orange-600">Mis Pedidos</h1>

    @forelse ($pedidos as $pedido)
        <div class="bg rounded-lg mb-6 p-4 border border-gray-200">
            <div class="flex justify-between mb-2 ">
                <div>
                    <span class="font-semibold">Pedido #{{ $pedido->id }}</span> |
                    <span class="text-gray-600 text-sm">Fecha: {{ $pedido->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <span class="text-sm px-2 py-1 rounded
                    @if($pedido->estado == 'pendiente') bg-yellow-200 text-yellow-800
                    @elseif($pedido->estado == 'preparando') bg-blue-200 text-blue-800
                    @elseif($pedido->estado == 'completado') bg-green-200 text-green-800
                    @else bg-red-200 text-red-800 @endif">
                    {{ ucfirst($pedido->estado) }}
                </span>
            </div>

            <ul class="list-disc ml-5 text-gray-700">
                @foreach($pedido->items as $item)
                    <li>{{ $item->producto->nombre }} (x{{ $item->cantidad }}) - ${{ $item->precio_unitario }}</li>
                @endforeach
            </ul>

            <div class="text-right font-bold text-lg text-orange-500 mt-2">
                Total: ${{ $pedido->monto_total }}
            </div>
        </div>
    @empty
        <p class="text-gray-600">No tienes pedidos registrados aún.</p>
    @endforelse
</div>
@endsection
