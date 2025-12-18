@extends('layouts.admin')

@section('title', 'Kelola Pesanan Makanan')

@section('content')
<div class="admin-breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin Panel</a> <span>/</span>
    <a href="{{ route('admin.food-orders.index') }}">Pesanan Makanan</a>
</div>

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Kelola Pesanan Makanan</h2>
    <div class="text-sm text-gray-600">
        Total: {{ $foodOrders->total() }} pesanan
    </div>
</div>

@if(session('success'))
    <div class="alert-admin alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert-admin alert-error">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm border">
    <div class="overflow-x-auto">
        <table class="table-admin">
            <thead>
                <tr>
                    <th>Pelanggan</th>
                    <th>Item Pesanan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Waktu Pengiriman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($foodOrders as $order)
                    <tr>
                        <td>
                            <div>
                                <div class="font-medium">{{ $order->customer_name }}</div>
                                <div class="text-sm text-gray-500">{{ $order->customer_email }}</div>
                                <div class="text-sm text-gray-500">{{ $order->customer_phone }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="max-w-xs">
                                @if($order->items)
                                    @foreach($order->items as $item)
                                        <div class="text-sm">{{ $item['name'] }} ({{ $item['quantity'] }})</div>
                                    @endforeach
                                @endif
                            </div>
                        </td>
                        <td class="font-semibold text-green-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td>
                            <span class="status-badge
                                @if($order->status == 'pending') status-pending
                                @elseif($order->status == 'confirmed') status-approved
                                @elseif($order->status == 'preparing') status-pending
                                @elseif($order->status == 'ready') status-approved
                                @elseif($order->status == 'delivered') status-approved
                                @else status-rejected
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->delivery_time ? \Carbon\Carbon::parse($order->delivery_time)->format('d M Y H:i') : 'N/A' }}</td>
                        <td>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.food-orders.edit', $order) }}" class="btn-admin btn-admin-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.food-orders.destroy', $order) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-sm font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-500">
                            <div class="text-4xl mb-2">🍽️</div>
                            Belum ada pesanan makanan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t">
        {{ $foodOrders->links() }}
    </div>
</div>
@endsection
