@extends('admin.layout')

@section('title', 'Manajemen Order')

@section('content')
<div class="flex flex-col gap-6">
    <!-- Header & Stats -->
    <div>
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Order</h1>
                <p class="text-sm text-gray-600">Kelola semua pesanan dan transaksi</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-lg border border-gray-200">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <i class="fas fa-shopping-cart text-blue-600"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-600">Total Order</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_orders'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-4 rounded-lg border border-gray-200">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <i class="fas fa-clock text-yellow-600"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-600">Pending</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['pending_orders'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-4 rounded-lg border border-gray-200">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-600">Selesai</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['completed_orders'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-4 rounded-lg border border-gray-200">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <i class="fas fa-money-bill-wave text-purple-600"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                        <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white p-4 rounded-lg border border-gray-200">
        <form method="GET" class="flex flex-wrap gap-4 items-center">
            <div class="flex-1 min-w-48">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari order ID, nama, email..." 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>
            <div>
                <input type="date" name="date_from" value="{{ request('date_from') }}" 
                       class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <input type="date" name="date_to" value="{{ request('date_to') }}" 
                       class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                <i class="fas fa-search"></i>
            </button>
            <a href="{{ route('admin.orders.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg transition-colors">
                <i class="fas fa-times"></i>
            </a>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left p-4 font-semibold text-gray-900">Order ID</th>
                        <th class="text-left p-4 font-semibold text-gray-900">Customer</th>
                        <th class="text-left p-4 font-semibold text-gray-900">Items</th>
                        <th class="text-center p-4 font-semibold text-gray-900">Total</th>
                        <th class="text-center p-4 font-semibold text-gray-900">Status</th>
                        <th class="text-center p-4 font-semibold text-gray-900">Tanggal</th>
                        <th class="text-center p-4 font-semibold text-gray-900">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="p-4">
                            <div class="font-mono font-medium text-blue-600">{{ $order->order_id }}</div>
                        </td>
                        <td class="p-4">
                            <div class="font-medium text-gray-900">{{ $order->customer_name }}</div>
                            <div class="text-sm text-gray-500">{{ $order->customer_email }}</div>
                            <div class="text-sm text-gray-500">{{ $order->customer_phone }}</div>
                        </td>
                        <td class="p-4">
                            <div class="text-sm">
                                @foreach($order->orderItems as $item)
                                <div>{{ $item->product_name }} ({{ $item->quantity }}x)</div>
                                @endforeach
                            </div>
                        </td>
                        <td class="p-4 text-center">
                            <span class="font-semibold text-gray-900">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            @switch($order->status)
                                @case('pending')
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-sm font-medium">Pending</span>
                                    @break
                                @case('processing')
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm font-medium">Processing</span>
                                    @break
                                @case('completed')
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm font-medium">Completed</span>
                                    @break
                                @case('cancelled')
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-sm font-medium">Cancelled</span>
                                    @break
                                @case('failed')
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-sm font-medium">Failed</span>
                                    @break
                                @default
                                    <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-sm font-medium">{{ $order->status }}</span>
                            @endswitch
                        </td>
                        <td class="p-4 text-center text-sm text-gray-600">
                            {{ $order->created_at->format('d M Y') }}<br>
                            {{ $order->created_at->format('H:i') }}
                        </td>
                        <td class="p-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:text-blue-900 transition-colors" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus order ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition-colors" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-4 text-gray-300"></i>
                            <p>Belum ada order yang masuk</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
        <div class="px-4 py-3 border-t border-gray-200">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection