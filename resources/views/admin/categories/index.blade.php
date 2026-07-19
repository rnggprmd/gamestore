@extends('admin.layout')

@section('title', 'Kategori Produk')

@section('content')
<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kategori Produk</h1>
            <p class="text-sm text-gray-600">Kelola kategori untuk produk game</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
            <i class="fas fa-plus"></i>
            Tambah Kategori
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white p-4 rounded-lg border border-gray-200">
        <form method="GET" class="flex gap-4 items-center">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                <i class="fas fa-search"></i>
            </button>
            <a href="{{ route('admin.categories.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg transition-colors">
                <i class="fas fa-times"></i>
            </a>
        </form>
    </div>

    <!-- Categories Table -->
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left p-4 font-semibold text-gray-900">Nama Kategori</th>
                        <th class="text-left p-4 font-semibold text-gray-900">Slug</th>
                        <th class="text-left p-4 font-semibold text-gray-900">Deskripsi</th>
                        <th class="text-center p-4 font-semibold text-gray-900">Jumlah Produk</th>
                        <th class="text-center p-4 font-semibold text-gray-900">Status</th>
                        <th class="text-center p-4 font-semibold text-gray-900">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="p-4">
                            <div class="font-medium text-gray-900">{{ $category->name }}</div>
                            <div class="text-sm text-gray-500">Dibuat {{ $category->created_at->format('d M Y') }}</div>
                        </td>
                        <td class="p-4 text-gray-600">{{ $category->slug }}</td>
                        <td class="p-4 text-gray-600">
                            {{ $category->description ? Str::limit($category->description, 50) : '-' }}
                        </td>
                        <td class="p-4 text-center">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm font-medium">
                                {{ $category->products_count }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            @if($category->status)
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm font-medium">Aktif</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-sm font-medium">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="p-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-600 hover:text-blue-900 transition-colors">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition-colors">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-4 text-gray-300"></i>
                            <p>Belum ada kategori yang ditambahkan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
        <div class="px-4 py-3 border-t border-gray-200">
            {{ $categories->links() }}
        </div>
        @endif
    </div>
</div>
@endsection