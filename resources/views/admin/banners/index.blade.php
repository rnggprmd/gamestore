@extends('admin.layout')

@section('page_title', 'Manajemen Banner')

@section('content')
<div class="space-y-6">
    <div class="bg-watt-surface border border-watt-border rounded-[16px] p-5 space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-white flex items-center gap-2">
                <i data-lucide="image" class="w-4 h-4 text-watt-cyan"></i>
                Daftar Banner
                <span class="font-mono text-sm text-watt-text-sec">({{ count($banners) }})</span>
            </h3>
            <button onclick="openModal('modal-create-banner')" class="inline-flex items-center gap-1.5 bg-watt-cyan hover:opacity-90 text-watt-bg text-xs font-bold px-4 py-2.5 rounded-xl transition-all cursor-pointer">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Banner
            </button>
        </div>

        <!-- Validation Errors -->
        @if($errors->any())
        <div class="p-4 bg-watt-alert-bg border-l-4 border-watt-red text-watt-red rounded-r-xl text-xs">
            <div class="font-bold flex items-center gap-1.5 mb-1.5"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> Terdapat kesalahan:</div>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="text-xs font-bold uppercase text-watt-text-sec border-b border-watt-border">
                        <th class="pb-3">Preview</th>
                        <th class="pb-3">Judul</th>
                        <th class="pb-3">Subtitle</th>
                        <th class="pb-3">Status</th>
                        <th class="pb-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-watt-border">
                    @forelse($banners as $banner)
                    <tr class="hover:bg-watt-hover transition-colors">
                        <td class="py-3.5">
                            @if($banner->image && file_exists(public_path('img/' . $banner->image)))
                                <img src="{{ asset('img/' . $banner->image) }}" alt="{{ $banner->title }}" class="w-24 h-14 rounded-xl object-cover border border-watt-border">
                            @else
                                <div class="w-24 h-14 rounded-xl bg-watt-cyan/10 flex items-center justify-center text-watt-cyan">
                                    <i data-lucide="image" class="w-5 h-5"></i>
                                </div>
                            @endif
                        </td>
                        <td class="py-3.5 font-semibold text-white">{{ $banner->title }}</td>
                        <td class="py-3.5 text-xs text-watt-text-sec max-w-xs truncate">{{ $banner->subtitle }}</td>
                        <td class="py-3.5">
                            @if($banner->status)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-watt-green/10 text-watt-green border border-watt-green/20 text-[10px] font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-watt-green animate-pulse"></span>Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-watt-hover text-watt-text-sec text-[10px] font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-watt-text-sec"></span>Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button
                                    onclick="openBannerEditModal(this)"
                                    data-id="{{ $banner->id }}"
                                    data-title="{{ e($banner->title) }}"
                                    data-subtitle="{{ e($banner->subtitle ?? '') }}"
                                    data-button-text="{{ e($banner->button_text ?? '') }}"
                                    data-button-link="{{ e($banner->button_link ?? '') }}"
                                    data-status="{{ $banner->status ? '1' : '0' }}"
                                    data-image="{{ $banner->image && file_exists(public_path('img/' . $banner->image)) ? asset('img/' . $banner->image) : '' }}"
                                    data-image-name="{{ $banner->image ?? '' }}"
                                    class="p-2 rounded-lg bg-watt-hover hover:bg-watt-cyan/10 hover:text-watt-cyan text-watt-text-sec transition-all cursor-pointer">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </button>
                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Hapus banner ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg bg-watt-hover hover:bg-watt-red/10 hover:text-watt-red text-watt-text-sec transition-all cursor-pointer">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-16 text-center text-watt-text-sec text-xs">
                            <i data-lucide="image" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
                            <p>Belum ada banner yang ditambahkan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ====== MODAL CREATE BANNER ====== -->
<div id="modal-create-banner" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal('modal-create-banner')"></div>
    <div class="relative w-full max-w-xl bg-watt-surface border border-watt-border rounded-[16px] p-6 shadow-2xl space-y-5 overflow-y-auto max-h-[90vh]">
        <div class="flex items-center justify-between border-b border-watt-border pb-4">
            <h3 class="text-base font-semibold text-white flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-4 h-4 text-watt-cyan"></i>Tambah Banner Baru
            </h3>
            <button onclick="closeModal('modal-create-banner')" class="p-1.5 rounded-lg hover:bg-watt-hover text-watt-text-sec hover:text-white cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="_form_type" value="create">
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Judul Banner <span class="text-watt-red">*</span></label>
                <input type="text" name="title" value="{{ old('_form_type') === 'create' ? old('title') : '' }}" required placeholder="Contoh: Promo Spesial!"
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Subtitle / Keterangan</label>
                <textarea name="subtitle" rows="2" placeholder="Keterangan singkat..."
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors resize-none">{{ old('_form_type') === 'create' ? old('subtitle') : '' }}</textarea>
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Gambar Banner <span class="text-watt-red">*</span></label>
                <input type="file" name="image" accept="image/*" required
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-3 py-2 text-sm text-watt-text-sec file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                <p class="text-[10px] text-watt-text-sec">Rasio landscape 16:6 direkomendasikan, maks. 2MB.</p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Teks Tombol</label>
                    <input type="text" name="button_text" value="{{ old('_form_type') === 'create' ? old('button_text') : '' }}" placeholder="Beli Sekarang"
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Link Tombol</label>
                    <input type="text" name="button_link" value="{{ old('_form_type') === 'create' ? old('button_link') : '' }}" placeholder="/game/mobile-legends"
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
                </div>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" id="create-banner-status" checked class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                <label for="create-banner-status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Banner Aktif</label>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-watt-border">
                <button type="button" onclick="closeModal('modal-create-banner')" class="px-5 py-2.5 rounded-xl bg-watt-hover hover:bg-[#333] text-watt-text-sec hover:text-white font-semibold text-xs transition-all cursor-pointer">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-watt-cyan hover:opacity-90 text-watt-bg font-bold text-xs transition-all cursor-pointer">Simpan Banner</button>
            </div>
        </form>
    </div>
</div>

<!-- ====== MODAL EDIT BANNER ====== -->
<div id="modal-edit-banner" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal('modal-edit-banner')"></div>
    <div class="relative w-full max-w-xl bg-watt-surface border border-watt-border rounded-[16px] p-6 shadow-2xl space-y-5 overflow-y-auto max-h-[90vh]">
        <div class="flex items-center justify-between border-b border-watt-border pb-4">
            <h3 class="text-base font-semibold text-white flex items-center gap-2">
                <i data-lucide="edit-3" class="w-4 h-4 text-watt-cyan"></i>Edit Banner
            </h3>
            <button onclick="closeModal('modal-edit-banner')" class="p-1.5 rounded-lg hover:bg-watt-hover text-watt-text-sec hover:text-white cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <form id="form-edit-banner" action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            <input type="hidden" name="_form_type" value="edit">
            <input type="hidden" name="_edit_id" id="edit-banner-hidden-id" value="">
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Judul Banner <span class="text-watt-red">*</span></label>
                <input type="text" id="edit-banner-title" name="title" required placeholder="Judul banner..."
                    value="{{ old('_form_type') === 'edit' ? old('title') : '' }}"
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Subtitle / Keterangan</label>
                <textarea id="edit-banner-subtitle" name="subtitle" rows="2"
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors resize-none">{{ old('_form_type') === 'edit' ? old('subtitle') : '' }}</textarea>
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Gambar Banner Baru</label>
                <div id="edit-banner-img-preview" class="hidden mb-2 rounded-xl overflow-hidden border border-watt-border">
                    <img id="edit-banner-img" src="" alt="" class="w-full h-28 object-cover">
                </div>
                <input type="file" name="image" accept="image/*"
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-3 py-2 text-sm text-watt-text-sec file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                <p class="text-[10px] text-watt-text-sec">Kosongkan jika tidak ingin mengganti.</p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Teks Tombol</label>
                    <input type="text" id="edit-banner-btn-text" name="button_text"
                        value="{{ old('_form_type') === 'edit' ? old('button_text') : '' }}"
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Link Tombol</label>
                    <input type="text" id="edit-banner-btn-link" name="button_link"
                        value="{{ old('_form_type') === 'edit' ? old('button_link') : '' }}"
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
                </div>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" id="edit-banner-status" class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                <label for="edit-banner-status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Banner Aktif</label>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-watt-border">
                <button type="button" onclick="closeModal('modal-edit-banner')" class="px-5 py-2.5 rounded-xl bg-watt-hover hover:bg-[#333] text-watt-text-sec hover:text-white font-semibold text-xs transition-all cursor-pointer">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-watt-cyan hover:opacity-90 text-watt-bg font-bold text-xs transition-all cursor-pointer">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
    document.body.style.overflow = '';
}
function openBannerEditModal(btn) {
    const id = btn.dataset.id;
    document.getElementById('form-edit-banner').action = '{{ url("admin/banners") }}/' + id;
    document.getElementById('edit-banner-hidden-id').value = id;
    document.getElementById('edit-banner-title').value = btn.dataset.title;
    document.getElementById('edit-banner-subtitle').value = btn.dataset.subtitle || '';
    document.getElementById('edit-banner-btn-text').value = btn.dataset.buttonText || '';
    document.getElementById('edit-banner-btn-link').value = btn.dataset.buttonLink || '';
    document.getElementById('edit-banner-status').checked = btn.dataset.status === '1';

    const imgPreview = document.getElementById('edit-banner-img-preview');
    if (btn.dataset.image) {
        document.getElementById('edit-banner-img').src = btn.dataset.image;
        imgPreview.classList.remove('hidden');
    } else { imgPreview.classList.add('hidden'); }

    openModal('modal-edit-banner');
}
@if($errors->any())
document.addEventListener('DOMContentLoaded', function() {
    @if(old('_form_type') === 'edit')
        openModal('modal-edit-banner');
        document.getElementById('form-edit-banner').action = '{{ url("admin/banners") }}/{{ old("_edit_id") }}';
        document.getElementById('edit-banner-hidden-id').value = '{{ old("_edit_id") }}';
        document.getElementById('edit-banner-title').value = @json(old('title') ?? '');
        document.getElementById('edit-banner-subtitle').value = @json(old('subtitle') ?? '');
        document.getElementById('edit-banner-btn-text').value = @json(old('button_text') ?? '');
        document.getElementById('edit-banner-btn-link').value = @json(old('button_link') ?? '');
        document.getElementById('edit-banner-status').checked = {{ old('status') ? 'true' : 'false' }};
    @else
        openModal('modal-create-banner');
    @endif
});
@endif
</script>
@endsection
