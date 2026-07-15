@extends('admin.layout')

@section('page_title', 'Tambah Testimoni')

@section('content')
<div class="max-w-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
    <div class="flex items-center gap-2 border-b border-slate-100 dark:border-slate-800 pb-4">
        <a href="{{ route('admin.testimonials.index') }}" class="p-2 rounded-lg bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 text-slate-500"><i data-lucide="arrow-left" class="w-4 h-4"></i></a>
        <h3 class="text-base font-bold text-slate-800 dark:text-white">Formulir Tambah Testimoni</h3>
    </div>

    @if($errors->any())
        <div class="p-4 rounded-xl bg-red-50 dark:bg-red-950/20 border border-red-200 dark:border-red-900/30 text-red-600 dark:text-red-400 text-xs">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.testimonials.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Pelanggan</label>
            <input type="text" name="customer_name" value="{{ old('customer_name') }}" required placeholder="Contoh: Budi Santoso" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
        </div>

        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Pesan / Ulasan</label>
            <textarea name="message" rows="4" required placeholder="Contoh: Proses top up sangat cepat dan harga terjangkau!" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">{{ old('message') }}</textarea>
        </div>

        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Rating (1 - 5)</label>
            <select name="rating" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
                <option value="">-- Pilih Rating --</option>
                @for($i = 5; $i >= 1; $i--)
                    <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                        {{ $i }} Bintang {{ $i == 5 ? '⭐⭐⭐⭐⭐' : ($i == 4 ? '⭐⭐⭐⭐' : ($i == 3 ? '⭐⭐⭐' : ($i == 2 ? '⭐⭐' : '⭐'))) }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="flex items-center gap-2 pt-2">
            <input type="checkbox" name="status" value="1" id="status" checked class="rounded text-violet-600 focus:ring-violet-500">
            <label for="status" class="text-xs font-bold text-slate-400 uppercase tracking-wider select-none cursor-pointer">Aktif (Ditampilkan di Landing Page)</label>
        </div>

        <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-3">
            <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 dark:text-slate-300 font-semibold text-xs transition-colors">Batal</a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-violet-600 hover:bg-violet-500 text-white font-bold text-xs transition-colors cursor-pointer">Simpan Testimoni</button>
        </div>
    </form>
</div>
@endsection
