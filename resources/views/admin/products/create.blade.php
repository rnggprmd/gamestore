@extends('admin.layout')

@section('page_title', 'Tambah Produk Baru')

@section('content')
<div class="max-w-2xl space-y-6">
    <div class="bg-watt-surface border border-watt-border rounded-[16px] p-6 space-y-6">
        <div class="flex items-center gap-3 border-b border-watt-border pb-4">
            <a href="{{ route('admin.products.index') }}" class="p-2 rounded-lg bg-watt-hover hover:bg-watt-bg text-watt-text-sec hover:text-white transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <h3 class="text-base font-bold text-white">Formulir Tambah Produk</h3>
        </div>

        @if($errors->any())
        <div class="p-4 bg-watt-alert-bg border-l-4 border-watt-red text-watt-red rounded-r-xl text-xs">
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Game <span class="text-watt-red">*</span></label>
                    <select name="game_id" required class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-watt-cyan transition-colors">
                        <option value="">-- Pilih Game --</option>
                        @foreach($games as $game)
                            <option value="{{ $game->id }}" {{ old('game_id') == $game->id ? 'selected' : '' }}>{{ $game->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Kategori <span class="text-watt-red">*</span></label>
                    <select name="category_id" required class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-watt-cyan transition-colors">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Nama Produk <span class="text-watt-red">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Diamond 86 atau Weekly Pass"
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Harga (IDR) <span class="text-watt-red">*</span></label>
                <input type="number" name="price" value="{{ old('price') }}" required min="0" placeholder="Contoh: 28000"
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors font-mono">
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Deskripsi (Opsional)</label>
                <textarea name="description" rows="2" placeholder="Deskripsi opsional..."
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors resize-none">{{ old('description') }}</textarea>
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Gambar Produk (Opsional)</label>
                <input type="file" name="image" accept="image/*"
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-3 py-2 text-sm text-watt-text-sec file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                <p class="text-[10px] text-watt-text-sec">File gambar maks. 2MB.</p>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" id="status" checked class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                <label for="status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Produk Aktif (Ditampilkan di detail game)</label>
            </div>
            <div class="pt-4 border-t border-watt-border flex justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-3 rounded-xl bg-watt-hover hover:bg-[#333] text-watt-text-sec hover:text-white font-semibold text-xs transition-colors">Batal</a>
                <button type="submit" class="px-6 py-3 rounded-xl bg-watt-cyan hover:opacity-90 text-watt-bg font-bold text-xs transition-colors cursor-pointer">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>
@endsection
