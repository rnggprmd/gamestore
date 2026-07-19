@extends('admin.layout')

@section('page_title', 'Edit Kategori')

@section('content')
<div class="admin-form-page-container">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <i data-lucide="edit-3" class="w-5 h-5 text-watt-cyan"></i>
            <div>
                <h1 class="text-xl font-semibold text-white">Edit Kategori</h1>
                <p class="text-xs text-watt-text-sec">Ubah informasi kategori "{{ $category->name }}"</p>
            </div>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="admin-button-secondary flex items-center gap-2">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="admin-form-card p-6">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Name -->
            <div class="space-y-2">
                <label class="admin-field-label">
                    Nama Kategori <span class="text-watt-red">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                       placeholder="Nama kategori..."
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
                <label class="admin-field-label">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $category->slug) }}"
                       placeholder="Slug kategori..."
                       class="admin-field font-mono @error('slug') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror">
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
                          class="admin-textarea @error('description') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="text-xs font-semibold text-watt-red flex items-center gap-1">
                        <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Status -->
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" id="category-status" {{ old('status', $category->status) ? 'checked' : '' }}
                       class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                <label for="category-status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Kategori Aktif</label>
            </div>

            <!-- Info Card -->
            <div class="bg-watt-surface/50 border border-watt-border rounded-xl p-4">
                <h3 class="text-sm font-semibold text-white mb-3 flex items-center gap-2">
                    <i data-lucide="info" class="w-4 h-4 text-watt-cyan"></i>
                    Informasi Kategori
                </h3>
                <div class="text-xs text-watt-text-sec space-y-2">
                    <div class="flex justify-between">
                        <span>Jumlah Produk:</span>
                        <span class="font-mono">{{ $category->products()->count() }} produk</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Dibuat:</span>
                        <span class="font-mono">{{ $category->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Diperbarui:</span>
                        <span class="font-mono">{{ $category->updated_at->format('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t border-watt-border">
                <a href="{{ route('admin.categories.index') }}" class="admin-button-secondary">
                    Batal
                </a>
                <button type="submit" class="admin-button-primary">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Update Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection