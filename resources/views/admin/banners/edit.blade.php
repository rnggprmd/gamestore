@extends('admin.layout')

@section('page_title', 'Edit Banner')

@section('content')
<div class="max-w-2xl space-y-6">
    <div class="bg-watt-surface border border-watt-border rounded-[16px] p-6 space-y-6">
        <div class="flex items-center gap-3 border-b border-watt-border pb-4">
            <a href="{{ route('admin.banners.index') }}" class="p-2 rounded-lg bg-watt-hover hover:bg-watt-bg text-watt-text-sec hover:text-white transition-colors">
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
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Judul Banner <span class="text-watt-red">*</span></label>
                <input type="text" name="title" value="{{ old('title', $banner->title) }}" required
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Subtitle / Keterangan</label>
                <textarea name="subtitle" rows="2"
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors resize-none">{{ old('subtitle', $banner->subtitle) }}</textarea>
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Gambar Banner Baru</label>
                @if($banner->image && file_exists(public_path('img/' . $banner->image)))
                <div class="mb-2 rounded-2xl overflow-hidden border border-watt-border">
                    <img src="{{ asset('img/' . $banner->image) }}" alt="Preview" class="w-full h-32 object-cover">
                </div>
                @endif
                <input type="file" name="image" accept="image/*"
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-3 py-2 text-sm text-watt-text-sec file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                <p class="text-[10px] text-watt-text-sec">Kosongkan jika tidak ingin mengganti gambar.</p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Teks Tombol</label>
                    <input type="text" name="button_text" value="{{ old('button_text', $banner->button_text) }}" placeholder="Beli Sekarang"
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Link Tombol</label>
                    <input type="text" name="button_link" value="{{ old('button_link', $banner->button_link) }}" placeholder="/game/..."
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
                </div>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" id="status" {{ $banner->status ? 'checked' : '' }} class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                <label for="status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Banner Aktif</label>
            </div>
            <div class="pt-4 border-t border-watt-border flex justify-end gap-3">
                <a href="{{ route('admin.banners.index') }}" class="px-6 py-3 rounded-xl bg-watt-hover hover:bg-[#333] text-watt-text-sec hover:text-white font-semibold text-xs transition-colors">Batal</a>
                <button type="submit" class="px-6 py-3 rounded-xl bg-watt-cyan hover:opacity-90 text-watt-bg font-bold text-xs transition-colors cursor-pointer">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
