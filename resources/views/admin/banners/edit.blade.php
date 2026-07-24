@extends('admin.layout')

@section('page_title', 'Edit Banner')

@section('content')
<div class="admin-form-page-container">
    <div class="admin-form-card p-6 space-y-6">
        <div class="flex items-center gap-3 border-b border-watt-border pb-4">
            <a href="{{ route('admin.banners.index') }}" class="admin-action-btn">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <h3 class="text-base font-bold text-white">Formulir Edit Banner</h3>
        </div>

        @if($errors->any())
        <div class="p-4 bg-watt-alert-bg border-l-4 border-watt-red text-watt-red rounded-r-xl text-xs">
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')
            <div class="space-y-1.5">
                <label class="admin-field-label">Judul Banner <span class="text-watt-red">*</span></label>
                <input type="text" name="title" value="{{ old('title', $banner->title) }}" required
                    class="admin-field">
            </div>
            <div class="space-y-1.5">
                <label class="admin-field-label">Subtitle / Keterangan</label>
                <textarea name="subtitle" rows="2"
                    class="admin-textarea">{{ old('subtitle', $banner->subtitle) }}</textarea>
            </div>
            <div class="space-y-1.5">
                <label class="admin-field-label">Gambar Banner Baru</label>
                @php
                    $bEditImg = get_image_url($banner->image);
                @endphp
                @if($bEditImg)
                <div class="mb-2 rounded-2xl overflow-hidden border border-watt-border">
                    <img src="{{ $bEditImg }}" alt="Preview" class="w-full h-32 object-cover">
                </div>
                @endif
                <input type="file" name="image" accept="image/*"
                    class="admin-field file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                <p class="text-[10px] text-watt-text-sec">Kosongkan jika tidak ingin mengganti gambar.</p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="admin-field-label">Teks Tombol</label>
                    <input type="text" name="button_text" value="{{ old('button_text', $banner->button_text) }}" placeholder="Beli Sekarang"
                        class="admin-field">
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Link Tombol</label>
                    <input type="text" name="button_link" value="{{ old('button_link', $banner->button_link) }}" placeholder="/game/..."
                        class="admin-field">
                </div>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" id="status" {{ $banner->status ? 'checked' : '' }} class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                <label for="status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Banner Aktif</label>
            </div>
            <div class="pt-4 border-t border-watt-border flex justify-end gap-3">
                <a href="{{ route('admin.banners.index') }}" class="admin-button-secondary">Batal</a>
                <button type="submit" class="admin-button-primary cursor-pointer">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

