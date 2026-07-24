@extends('admin.layout')

@section('page_title', 'Manajemen Banner')

@section('content')
<div class="space-y-6">
    <div class="admin-form-card p-5 space-y-4">
        <!-- Filter Section Marker -->
        <div class="flex items-center gap-2">
            <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-watt-cyan/10 border border-watt-cyan/20">
                <i data-lucide="sliders-horizontal" class="w-3.5 h-3.5 text-watt-cyan"></i>
                <span class="text-[11px] font-bold text-watt-cyan uppercase tracking-widest">Filter & Pencarian</span>
            </div>
        </div>
        <!-- Search & Filter (Integrated) -->
        <form method="GET" class="search-filter-form grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-end pb-4 border-b border-watt-border">
            <!-- Search Input -->
            <div class="sm:col-span-2 lg:col-span-1">
                <label class="admin-field-label text-xs mb-1.5">🔍 Cari</label>
                <input type="text" name="search" value="{{ $search ?? '' }}" 
                    placeholder="Cari..." autocomplete="off"
                    class="admin-field text-sm h-9 py-2"
                    onkeyup="autoSubmitForm(this)">
            </div>

            <!-- Status Filter -->
            <div>
                <label class="admin-field-label text-xs mb-1.5">Status</label>
                <select name="status" class="admin-field text-sm h-9 py-2" onchange="autoSubmitForm(this)">
                    <option value="">Semua Status</option>
                    <option value="active" {{ ($status ?? '') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ ($status ?? '') === 'inactive' ? 'selected' : '' }}>Non-aktif</option>
                </select>
            </div>

            <!-- Sort Filter -->
            <div>
                <label class="admin-field-label text-xs mb-1.5">Urutkan</label>
                <select name="sort" class="admin-field text-sm h-9 py-2" onchange="autoSubmitForm(this)">
                    <option value="latest" {{ ($sort ?? 'latest') === 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ ($sort ?? '') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="order" {{ ($sort ?? '') === 'order' ? 'selected' : '' }}>Urutan</option>
                </select>
            </div>

            <!-- Reset Button -->
            <div>
                <a href="{{ request()->getBaseUrl() . request()->getPathInfo() }}" class="admin-button-secondary w-full text-xs px-3 py-2 flex items-center justify-center gap-2 border border-watt-border text-watt-text-sec hover:bg-watt-hover rounded-lg transition h-9">
                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                    <span>Reset</span>
                </a>
            </div>
        </form>

        <!-- Header with Add Button -->
        <div class="flex items-center justify-between pt-2">
            <div class="flex items-center gap-2">
                <i data-lucide="image" class="w-4 h-4 text-watt-cyan"></i>
                <span class="text-sm font-semibold text-white">Daftar Banner <span class="font-mono text-xs text-watt-text-sec">({{ count($banners) }})</span></span>
            </div>
            <button onclick="openModal('modal-create-banner')" class="inline-flex items-center gap-1.5 bg-watt-cyan hover:opacity-90 text-watt-bg text-xs font-bold px-4 py-2.5 rounded-xl transition-all cursor-pointer flex-shrink-0">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Banner
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-auto admin-table-shell admin-table-scroll max-h-[600px]">
            <table class="admin-table">
                <thead>
                    <tr class="admin-table-head">
                        <th class="admin-table-head w-16">No.</th>
                        <th class="admin-table-head">Preview</th>
                        <th class="admin-table-head">Judul</th>
                        <th class="admin-table-head">Subtitle</th>
                        <th class="admin-table-head">Waktu Ditambah</th>
                        <th class="admin-table-head">Status</th>
                        <th class="admin-table-head text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-watt-border">
                    @forelse($banners as $index => $banner)
                    <tr class="admin-table-row">
                        <td class="py-3.5 text-center text-sm font-medium text-watt-text-sec">{{ $index + 1 }}</td>
                        <td class="py-3.5">
                            @php
                                $bImg = get_image_url($banner->image);
                            @endphp
                            @if($bImg)
                                <img src="{{ $bImg }}" alt="{{ $banner->title }}" class="w-24 h-14 rounded-xl object-cover border border-watt-border">
                            @else
                                <div class="w-24 h-14 rounded-xl bg-watt-cyan/10 flex items-center justify-center text-watt-cyan">
                                    <i data-lucide="image" class="w-5 h-5"></i>
                                </div>
                            @endif
                        </td>
                        <td class="py-3.5 font-semibold text-white">{{ $banner->title }}</td>
                        <td class="py-3.5 text-xs text-watt-text-sec max-w-xs truncate">{{ $banner->subtitle }}</td>
                        <td class="py-3.5 text-xs text-watt-text-sec">
                            <div class="flex flex-col">
                                <span>{{ $banner->created_at->format('d M Y') }}</span>
                                <span class="text-[10px] text-watt-text-sec/70">{{ $banner->created_at->format('H:i') }}</span>
                            </div>
                        </td>
                        <td class="py-3.5">
                            @if($banner->status)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-watt-green/10 text-watt-green border border-watt-green/20 text-[10px] font-bold whitespace-nowrap">
                                    <span class="w-1.5 h-1.5 rounded-full bg-watt-green animate-pulse"></span>Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-watt-hover text-watt-text-sec text-[10px] font-bold whitespace-nowrap">
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
                                    data-image="{{ $bImg ?? '' }}"
                                    data-image-name="{{ $banner->image ?? '' }}"
                                    class="admin-action-btn admin-action-btn--edit">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </button>
                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Hapus banner ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="admin-action-btn admin-action-btn--delete">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-16 text-center text-watt-text-sec text-xs">
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
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 class="text-base font-semibold text-white flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-4 h-4 text-watt-cyan"></i>Tambah Banner Baru
            </h3>
            <button onclick="closeModal('modal-create-banner')" class="p-1.5 rounded-lg hover:bg-watt-hover text-watt-text-sec hover:text-white cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1 min-h-0" onsubmit="this.querySelector('button[type=submit]').disabled = true;">
            @csrf
            <input type="hidden" name="_form_type" value="create">
            <div class="admin-modal-body">
                <div class="space-y-1.5">
                    <label class="admin-field-label">Judul Banner <span class="text-watt-red">*</span></label>
                    <input type="text" name="title" value="{{ session('_form_type') === 'create' ? old('title') : '' }}" required placeholder="Contoh: Promo Spesial!"
                        class="admin-field @if(session('_form_type') === 'create') @error('title') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror @endif">
                    @if(session('_form_type') === 'create')
                        @error('title')
                            <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Subtitle / Keterangan</label>
                    <textarea name="subtitle" rows="2" placeholder="Keterangan singkat..."
                        class="admin-textarea">{{ session('_form_type') === 'create' ? old('subtitle') : '' }}</textarea>
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Gambar Banner <span class="text-watt-red">*</span></label>
                    <input type="file" name="image" accept="image/*" required
                        class="admin-field file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                    <p class="text-[10px] text-watt-text-sec">Rasio landscape 16:6 direkomendasikan, maks. 2MB.</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="admin-field-label">Teks Tombol</label>
                        <input type="text" name="button_text" value="{{ session('_form_type') === 'create' ? old('button_text') : '' }}" placeholder="Beli Sekarang"
                            class="admin-field">
                    </div>
                    <div class="space-y-1.5">
                        <label class="admin-field-label">Link Tombol</label>
                        <input type="text" name="button_link" value="{{ session('_form_type') === 'create' ? old('button_link') : '' }}" placeholder="/game/mobile-legends"
                            class="admin-field">
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="status" value="1" id="create-banner-status" checked class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                    <label for="create-banner-status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Banner Aktif</label>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" onclick="closeModal('modal-create-banner')" class="admin-button-secondary cursor-pointer">Batal</button>
                <button type="submit" class="admin-button-primary cursor-pointer">Simpan Banner</button>
            </div>
        </form>
    </div>
</div>

<!-- ====== MODAL EDIT BANNER ====== -->
<div id="modal-edit-banner" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal('modal-edit-banner')"></div>
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 class="text-base font-semibold text-white flex items-center gap-2">
                <i data-lucide="edit-3" class="w-4 h-4 text-watt-cyan"></i>Edit Banner
            </h3>
            <button onclick="closeModal('modal-edit-banner')" class="p-1.5 rounded-lg hover:bg-watt-hover text-watt-text-sec hover:text-white cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <form id="form-edit-banner" action="" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1 min-h-0" onsubmit="this.querySelector('button[type=submit]').disabled = true;">
            @csrf @method('PUT')
            <input type="hidden" name="_form_type" value="edit">
            <input type="hidden" name="_edit_id" id="edit-banner-hidden-id" value="">
            <div class="admin-modal-body">
                <div class="space-y-1.5">
                    <label class="admin-field-label">Judul Banner <span class="text-watt-red">*</span></label>
                    <input type="text" id="edit-banner-title" name="title" required placeholder="Judul banner..."
                        value="{{ session('_form_type') === 'edit' ? old('title') : '' }}"
                        class="admin-field @if(session('_form_type') === 'edit') @error('title') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror @endif">
                    @if(session('_form_type') === 'edit')
                        @error('title')
                            <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Subtitle / Keterangan</label>
                    <textarea id="edit-banner-subtitle" name="subtitle" rows="2"
                        class="admin-textarea">{{ session('_form_type') === 'edit' ? old('subtitle') : '' }}</textarea>
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Gambar Banner Baru</label>
                    <div id="edit-banner-img-preview" class="hidden mb-2 rounded-xl overflow-hidden border border-watt-border">
                        <img id="edit-banner-img" src="" alt="" class="w-full h-28 object-cover">
                    </div>
                    <input type="file" name="image" accept="image/*"
                        class="admin-field file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                    <p class="text-[10px] text-watt-text-sec">Kosongkan jika tidak ingin mengganti.</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="admin-field-label">Teks Tombol</label>
                        <input type="text" id="edit-banner-btn-text" name="button_text"
                            value="{{ session('_form_type') === 'edit' ? old('button_text') : '' }}"
                            class="admin-field">
                    </div>
                    <div class="space-y-1.5">
                        <label class="admin-field-label">Link Tombol</label>
                        <input type="text" id="edit-banner-btn-link" name="button_link"
                            value="{{ session('_form_type') === 'edit' ? old('button_link') : '' }}"
                            class="admin-field">
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="status" value="1" id="edit-banner-status" class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                    <label for="edit-banner-status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Banner Aktif</label>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" onclick="closeModal('modal-edit-banner')" class="admin-button-secondary cursor-pointer">Batal</button>
                <button type="submit" class="admin-button-primary cursor-pointer">Simpan Perubahan</button>
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
document.addEventListener('DOMContentLoaded', function() {
    @if($errors->any())
        @if(session('_form_type') === 'edit')
            document.body.style.overflow = 'hidden';
            document.getElementById('form-edit-banner').action = '{{ url("admin/banners") }}/{{ session("_edit_id") }}';
            document.getElementById('edit-banner-hidden-id').value = '{{ session("_edit_id") }}';
            document.getElementById('edit-banner-title').value = @json(old('title') ?? '');
            document.getElementById('edit-banner-subtitle').value = @json(old('subtitle') ?? '');
            document.getElementById('edit-banner-btn-text').value = @json(old('button_text') ?? '');
            document.getElementById('edit-banner-btn-link').value = @json(old('button_link') ?? '');
            document.getElementById('edit-banner-status').checked = {{ old('status') ? 'true' : 'false' }};
            openModal('modal-edit-banner');
        @else
            openModal('modal-create-banner');
        @endif

        lucide.createIcons();

        // Tampilkan error toast dengan delay untuk memastikan modal sudah visible
        setTimeout(() => {
            @foreach($errors->all() as $error)
                showToast('{{ $error }}', 'error', 5000);
            @endforeach
        }, 300);
    @endif
});

let searchTimeout;
function autoSubmitForm(button) {
    clearTimeout(searchTimeout);
    const form = button.closest('.search-filter-form');
    searchTimeout = setTimeout(() => {
        form.submit();
    }, 500);
}
</script>
@endsection
