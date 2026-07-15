@extends('admin.layout')

@section('page_title', 'Edit Produk: ' . $product->name)

@section('content')
<div class="max-w-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
    <div class="flex items-center gap-2 border-b border-slate-100 dark:border-slate-800 pb-4">
        <a href="{{ route('admin.products.index') }}" class="p-2 rounded-lg bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 text-slate-500"><i data-lucide="arrow-left" class="w-4 h-4"></i></a>
        <h3 class="text-base font-bold text-slate-800 dark:text-white">Formulir Edit Produk</h3>
    </div>

    <!-- Error block -->
    @if($errors->any())
        <div class="p-4 rounded-xl bg-red-50 dark:bg-red-950/20 border border-red-200 dark:border-red-900/30 text-red-600 dark:text-red-400 text-xs">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Game Select -->
        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Game</label>
            <select name="game_id" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
                @foreach($games as $game)
                    <option value="{{ $game->id }}" {{ old('game_id', $product->game_id) == $game->id ? 'selected' : '' }}>{{ $game->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Category Select -->
        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Kategori Produk</label>
            <select name="category_id" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Name -->
        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required placeholder="Contoh: Diamond 86 atau Weekly Pass" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
        </div>

        <!-- Price -->
        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Harga (IDR)</label>
            <input type="number" name="price" value="{{ old('price', (int)$product->price) }}" required min="0" placeholder="Contoh: 28000" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
        </div>

        <!-- Description -->
        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Deskripsi Produk (Opsional)</label>
            <textarea name="description" rows="2" placeholder="Deskripsi opsional..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Product Image (Optional) -->
        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Gambar / Ikon Produk (Opsional)</label>

            @if($product->image && file_exists(public_path('img/' . $product->image)))
                <div class="mb-3 flex items-center gap-3 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 p-3 rounded-2xl">
                    <img src="{{ asset('img/' . $product->image) }}" alt="Preview" class="w-12 h-12 rounded-xl object-cover">
                    <span class="text-xs text-slate-400 font-mono truncate max-w-[150px]">{{ $product->image }}</span>
                </div>
            @endif

            <input type="file" name="image" accept="image/*" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-sm text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-violet-600 file:text-white hover:file:bg-violet-500">
            <p class="text-[10px] text-slate-400">Pilih file baru jika ingin mengganti gambar. Maksimal 2MB.</p>
        </div>

        <!-- Status -->
        <div class="flex items-center gap-2 pt-2">
            <input type="checkbox" name="status" value="1" id="status" {{ $product->status ? 'checked' : '' }} class="rounded bg-slate-50 dark:bg-slate-950 border-slate-200 dark:border-slate-800 text-violet-600 focus:ring-violet-500">
            <label for="status" class="text-xs font-bold text-slate-300 uppercase tracking-wider select-none cursor-pointer">Produk Aktif (Ditampilkan di detail game)</label>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-3">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 rounded-xl bg-slate-100 dark:bg-slate-850 hover:bg-slate-200 text-slate-600 dark:text-slate-300 font-semibold text-xs transition-colors">Batal</a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-violet-600 hover:bg-violet-500 text-white font-bold text-xs transition-colors cursor-pointer">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
