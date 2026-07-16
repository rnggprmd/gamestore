@extends('admin.layout')

@section('page_title', 'Tambah Banner Baru')

@section('content')
<div class="admin-form-page-container">
    <div class="admin-form-card p-6 space-y-6">
        <div class="flex items-center gap-3 border-b border-watt-border pb-4">
            <a href="{{ route('admin.banners.index') }}" class="admin-action-btn">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <h3 class="text-base font-bold text-white">Formulir Tambah Banner</h3>
        </div>

        @if($errors->any())
        <div class="p-4 bg-watt-alert-bg border-l-4 border-watt-red text-watt-red rounded-r-xl text-xs">
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="space-y-1.5">
                <label class="admin-field-label">Judul Banner <span class="text-watt-red">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Promo Spesial Ramadan!"
                    class="admin-field">
            </div>
            <div class="space-y-1.5">
                <label class="admin-field-label">Subtitle / Keterangan</label>
                <textarea name="subtitle" rows="2" placeholder="Keterangan singkat..."
                    class="admin-textarea">{{ old('subtitle') }}</textarea>
            </div>
            <div class="space-y-1.5">
                <label class="admin-field-label">Gambar Banner <span class="text-watt-red">*</span></label>
                <input type="file" name="image" accept="image/*" required
                    class="admin-field file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                <p class="text-[10px] text-watt-text-sec">Rasio landscape (16:6) direkomendasikan. Maks. 2MB.</p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="admin-field-label">Teks Tombol (Opsional)</label>
                    <input type="text" name="button_text" value="{{ old('button_text') }}" placeholder="Beli Sekarang"
                        class="admin-field">
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Link Tombol (Opsional)</label>
                    <input type="text" name="button_link" value="{{ old('button_link') }}" placeholder="/game/mobile-legends"
                        class="admin-field">
                </div>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" id="status" checked class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                <label for="status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Banner Aktif (Ditampilkan di Hero Slider)</label>
            </div>
            <div class="pt-4 border-t border-watt-border flex justify-end gap-3">
                <a href="{{ route('admin.banners.index') }}" class="admin-button-secondary">Batal</a>
                <button type="submit" class="admin-button-primary cursor-pointer">Simpan Banner</button>
            </div>
        </form>
    </div>
</div>
@endsection

