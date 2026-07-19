@extends('admin.layout')

@section('page_title', 'Tambah Kategori')

@section('content')
<div class="admin-form-page-container">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <i data-lucide="plus-circle" class="w-5 h-5 text-watt-cyan"></i>
            <div>
                <h1 class="text-xl font-semibold text-white">Tambah Kategori Baru</h1>
                <p class="text-xs text-watt-text-sec">Buat kategori baru untuk produk game</p>
            </div>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="admin-button-secondary flex items-center gap-2">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="admin-form-card p-6">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Name -->
            <div class="space-y-2">
                <label class="admin-field-label">
                    Nama Kategori <span class="text-watt-red">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       placeholder="Contoh: Diamond atau Weekly Pass"
                       class="admin-field @error('name') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror">
                @error('name')
                    <p class="text-xs font-semibold text-watt-red flex items-center gap-1">
                        <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Slug -->
            <div class="space-y-2">
                <label class="admin-field-label">Slug (Opsional)</label>
                <input type="text" name="slug" value="{{ old('slug') }}"
                       placeholder="Auto-generate dari nama jika kosong"
                       class="admin-field font-mono @error('slug') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror">
                <p class="text-[10px] text-watt-text-sec">Akan dibuat otomatis dari nama jika dikosongkan.</p>
                @error('slug')
                    <p class="text-xs font-semibold text-watt-red flex items-center gap-1">
                        <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <label class="admin-field-label">Deskripsi (Opsional)</label>
                <textarea name="description" rows="3"
                          placeholder="Deskripsi kategori..."
                          class="admin-textarea @error('description') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-xs font-semibold text-watt-red flex items-center gap-1">
                        <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Status -->
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" id="category-status" {{ old('status', true) ? 'checked' : '' }}
                       class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                <label for="category-status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Kategori Aktif</label>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t border-watt-border">
                <a href="{{ route('admin.categories.index') }}" class="admin-button-secondary">
                    Batal
                </a>
                <button type="submit" class="admin-button-primary">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection