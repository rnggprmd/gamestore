@extends('admin.layout')

@section('page_title', 'Edit Game: ' . $game->name)

@section('content')
<div class="admin-form-page-container">
    <div class="admin-form-card p-6 space-y-6">
        <div class="flex items-center gap-3 border-b border-watt-border pb-4">
            <a href="{{ route('admin.games.index') }}" class="admin-action-btn">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <h3 class="text-base font-bold text-white">Formulir Edit Game</h3>
        </div>

        @if($errors->any())
        <div class="p-4 bg-watt-alert-bg border-l-4 border-watt-red text-watt-red rounded-r-xl text-xs">
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.games.update', $game->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')
            <div class="space-y-1.5">
                <label class="admin-field-label">Nama Game <span class="text-watt-red">*</span></label>
                <input type="text" name="name" value="{{ old('name', $game->name) }}" required placeholder="Nama game..."
                    class="admin-field">
            </div>
            <div class="space-y-1.5">
                <label class="admin-field-label">Deskripsi Singkat</label>
                <textarea name="description" rows="3"
                    class="admin-textarea">{{ old('description', $game->description) }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="admin-field-label">Logo / Thumbnail Baru</label>
                    @if($game->thumbnail && file_exists(public_path('img/' . $game->thumbnail)))
                    <div class="mb-2 flex items-center gap-3 bg-watt-bg border border-watt-border p-3 rounded-xl">
                        <img src="{{ asset('img/' . $game->thumbnail) }}" alt="Preview" class="w-12 h-12 rounded-xl object-cover">
                        <span class="text-[10px] text-watt-text-sec font-mono truncate">{{ $game->thumbnail }}</span>
                    </div>
                    @endif
                    <input type="file" name="thumbnail" accept="image/*"
                        class="admin-field file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                    <p class="text-[10px] text-watt-text-sec">Kosongkan jika tidak ingin mengganti.</p>
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Banner Detail Baru</label>
                    @if($game->banner && file_exists(public_path('img/' . $game->banner)))
                    <div class="mb-2 flex items-center gap-3 bg-watt-bg border border-watt-border p-3 rounded-xl">
                        <img src="{{ asset('img/' . $game->banner) }}" alt="Preview" class="w-20 h-12 rounded-lg object-cover">
                        <span class="text-[10px] text-watt-text-sec font-mono truncate">{{ $game->banner }}</span>
                    </div>
                    @endif
                    <input type="file" name="banner" accept="image/*"
                        class="admin-field file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                    <p class="text-[10px] text-watt-text-sec">Kosongkan jika tidak ingin mengganti.</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" id="status" {{ $game->status ? 'checked' : '' }} class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                <label for="status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Game Aktif (Ditampilkan di Landing Page)</label>
            </div>
            <div class="pt-4 border-t border-watt-border flex justify-end gap-3">
                <a href="{{ route('admin.games.index') }}" class="admin-button-secondary">Batal</a>
                <button type="submit" class="admin-button-primary cursor-pointer">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

