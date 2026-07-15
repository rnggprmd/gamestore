@extends('admin.layout')

@section('page_title', 'Edit Banner')

@section('content')
<div class="max-w-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
    <div class="flex items-center gap-2 border-b border-slate-100 dark:border-slate-800 pb-4">
        <a href="{{ route('admin.banners.index') }}" class="p-2 rounded-lg bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 text-slate-500"><i data-lucide="arrow-left" class="w-4 h-4"></i></a>
        <h3 class="text-base font-bold text-slate-800 dark:text-white">Formulir Edit Banner</h3>
    </div>

    @if($errors->any())
        <div class="p-4 rounded-xl bg-red-50 dark:bg-red-950/20 border border-red-200 dark:border-red-900/30 text-red-600 dark:text-red-400 text-xs">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Judul Banner</label>
            <input type="text" name="title" value="{{ old('title', $banner->title) }}" required placeholder="Judul banner..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
        </div>

        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Subtitle / Keterangan</label>
            <textarea name="subtitle" rows="2" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">{{ old('subtitle', $banner->subtitle) }}</textarea>
        </div>

        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Gambar Banner</label>
            @if($banner->image && file_exists(public_path('img/' . $banner->image)))
                <div class="mb-3 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-800">
                    <img src="{{ asset('img/' . $banner->image) }}" alt="Banner Preview" class="w-full h-32 object-cover">
                </div>
            @endif
            <input type="file" name="image" accept="image/*" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-sm text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-violet-600 file:text-white hover:file:bg-violet-500">
            <p class="text-[10px] text-slate-400">Pilih file baru untuk mengganti gambar. Maksimal 2MB.</p>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="space-y-2">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Teks Tombol</label>
                <input type="text" name="button_text" value="{{ old('button_text', $banner->button_text) }}" placeholder="Contoh: Beli Sekarang" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
            </div>
            <div class="space-y-2">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Link Tombol</label>
                <input type="text" name="button_link" value="{{ old('button_link', $banner->button_link) }}" placeholder="/game/mobile-legends" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
            </div>
        </div>

        <div class="flex items-center gap-2 pt-2">
            <input type="checkbox" name="status" value="1" id="status" {{ $banner->status ? 'checked' : '' }} class="rounded text-violet-600 focus:ring-violet-500">
            <label for="status" class="text-xs font-bold text-slate-400 uppercase tracking-wider select-none cursor-pointer">Banner Aktif (Ditampilkan di Hero Slider)</label>
        </div>

        <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-3">
            <a href="{{ route('admin.banners.index') }}" class="px-6 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 dark:text-slate-300 font-semibold text-xs transition-colors">Batal</a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-violet-600 hover:bg-violet-500 text-white font-bold text-xs transition-colors cursor-pointer">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
