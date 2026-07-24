@extends('admin.layout')

@section('page_title', 'Edit Produk: ' . $product->name)

@section('content')
<div class="admin-form-page-container">
    <div class="admin-form-card p-6 space-y-6">
        <div class="flex items-center gap-3 border-b border-watt-border pb-4">
            <a href="{{ route('admin.products.index') }}" class="admin-action-btn">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <h3 class="text-base font-bold text-white">Formulir Edit Produk</h3>
        </div>

        @if($errors->any())
        <div class="p-4 bg-watt-alert-bg border-l-4 border-watt-red text-watt-red rounded-r-xl text-xs">
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="admin-field-label">Game <span class="text-watt-red">*</span></label>
                    <select name="game_id" required class="admin-select">
                        @foreach($games as $game)
                            <option value="{{ $game->id }}" {{ old('game_id', $product->game_id) == $game->id ? 'selected' : '' }}>{{ $game->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Kategori <span class="text-watt-red">*</span></label>
                    <select name="category_id" required class="admin-select">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="space-y-1.5">
                <label class="admin-field-label">Nama Produk <span class="text-watt-red">*</span></label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                    class="admin-field">
            </div>
            <div class="space-y-1.5">
                <label class="admin-field-label">Harga (IDR) <span class="text-watt-red">*</span></label>
                <input type="number" name="price" value="{{ old('price', (int)$product->price) }}" required min="0"
                    class="admin-field font-mono">
            </div>
            <div class="space-y-1.5">
                <label class="admin-field-label">Deskripsi (Opsional)</label>
                <textarea name="description" rows="2"
                    class="admin-textarea">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="space-y-1.5">
                <label class="admin-field-label">Gambar Baru (Opsional)</label>
                @php
                    $pEditImg = get_image_url($product->image);
                @endphp
                @if($pEditImg)
                <div class="mb-2 flex items-center gap-3 bg-watt-bg border border-watt-border p-3 rounded-xl">
                    <img src="{{ $pEditImg }}" alt="Preview" class="w-12 h-12 rounded-xl object-cover">
                    <span class="text-[10px] text-watt-text-sec font-mono truncate">{{ $product->image }}</span>
                </div>
                @endif
                <input type="file" name="image" accept="image/*"
                    class="admin-field file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                <p class="text-[10px] text-watt-text-sec">Kosongkan jika tidak ingin mengganti.</p>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" id="status" {{ $product->status ? 'checked' : '' }} class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                <label for="status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Produk Aktif</label>
            </div>
            <div class="pt-4 border-t border-watt-border flex justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" class="admin-button-secondary">Batal</a>
                <button type="submit" class="admin-button-primary cursor-pointer">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection


