@extends('admin.layout')

@section('page_title', 'Edit Testimoni')

@section('content')
<div class="admin-form-page-container">
    <div class="admin-form-card p-6 space-y-6">
        <div class="flex items-center gap-3 border-b border-watt-border pb-4">
            <a href="{{ route('admin.testimonials.index') }}" class="admin-action-btn">
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
                <label class="admin-field-label">Nama Pelanggan <span class="text-watt-red">*</span></label>
                <input type="text" name="customer_name" value="{{ old('customer_name', $testimonial->customer_name) }}" required
                    class="admin-field">
            </div>
            <div class="space-y-1.5">
                <label class="admin-field-label">Pesan / Ulasan <span class="text-watt-red">*</span></label>
                <textarea name="message" rows="4" required
                    class="admin-textarea">{{ old('message', $testimonial->message) }}</textarea>
            </div>
            <div class="space-y-1.5">
                <label class="admin-field-label">Rating (1 - 5) <span class="text-watt-red">*</span></label>
                <select name="rating" required class="admin-select">
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
                <a href="{{ route('admin.testimonials.index') }}" class="admin-button-secondary">Batal</a>
                <button type="submit" class="admin-button-primary cursor-pointer">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

