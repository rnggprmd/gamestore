@extends('admin.layout')

@section('page_title', 'Edit Testimoni')

@section('content')
<div class="max-w-2xl space-y-6">
    <div class="bg-watt-surface border border-watt-border rounded-[16px] p-6 space-y-6">
        <div class="flex items-center gap-3 border-b border-watt-border pb-4">
            <a href="{{ route('admin.testimonials.index') }}" class="p-2 rounded-lg bg-watt-hover hover:bg-watt-bg text-watt-text-sec hover:text-white transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <h3 class="text-base font-bold text-white">Formulir Edit Testimoni</h3>
        </div>

        @if($errors->any())
        <div class="p-4 bg-watt-alert-bg border-l-4 border-watt-red text-watt-red rounded-r-xl text-xs">
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Nama Pelanggan <span class="text-watt-red">*</span></label>
                <input type="text" name="customer_name" value="{{ old('customer_name', $testimonial->customer_name) }}" required
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Pesan / Ulasan <span class="text-watt-red">*</span></label>
                <textarea name="message" rows="4" required
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors resize-none">{{ old('message', $testimonial->message) }}</textarea>
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Rating (1 - 5) <span class="text-watt-red">*</span></label>
                <select name="rating" required class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-watt-cyan transition-colors">
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>
                            {{ $i }} Bintang {{ str_repeat('⭐', $i) }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" id="status" {{ $testimonial->status ? 'checked' : '' }} class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                <label for="status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Aktif (Ditampilkan di Landing Page)</label>
            </div>
            <div class="pt-4 border-t border-watt-border flex justify-end gap-3">
                <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-3 rounded-xl bg-watt-hover hover:bg-[#333] text-watt-text-sec hover:text-white font-semibold text-xs transition-colors">Batal</a>
                <button type="submit" class="px-6 py-3 rounded-xl bg-watt-cyan hover:opacity-90 text-watt-bg font-bold text-xs transition-colors cursor-pointer">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
