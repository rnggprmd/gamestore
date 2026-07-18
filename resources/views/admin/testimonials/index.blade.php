@extends('admin.layout')

@section('page_title', 'Ulasan / Testimoni')

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
        <form method="GET" class="search-filter-form grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 items-end pb-4 border-b border-watt-border">
            <!-- Search Input -->
            <div>
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
                    <option value="rating_asc" {{ ($sort ?? '') === 'rating_asc' ? 'selected' : '' }}>Rating ↑</option>
                    <option value="rating_desc" {{ ($sort ?? '') === 'rating_desc' ? 'selected' : '' }}>Rating ↓</option>
                </select>
            </div>

            <!-- Rating Filter -->
            <div>
                <label class="admin-field-label text-xs mb-1.5">Rating</label>
                <select name="rating" class="admin-field text-sm h-9 py-2" onchange="autoSubmitForm(this)">
                    <option value="">Semua Rating</option>
                    <option value="5" {{ ($rating ?? '') === '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐</option>
                    <option value="4" {{ ($rating ?? '') === '4' ? 'selected' : '' }}>⭐⭐⭐⭐</option>
                    <option value="3" {{ ($rating ?? '') === '3' ? 'selected' : '' }}>⭐⭐⭐</option>
                    <option value="2" {{ ($rating ?? '') === '2' ? 'selected' : '' }}>⭐⭐</option>
                    <option value="1" {{ ($rating ?? '') === '1' ? 'selected' : '' }}>⭐</option>
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
                <i data-lucide="message-square" class="w-4 h-4 text-watt-cyan"></i>
                <span class="text-sm font-semibold text-white">Daftar Testimoni <span class="font-mono text-xs text-watt-text-sec">({{ count($testimonials) }})</span></span>
            </div>
            <button onclick="openModal('modal-create-testimonial')" class="inline-flex items-center gap-1.5 bg-watt-cyan hover:opacity-90 text-watt-bg text-xs font-bold px-4 py-2.5 rounded-xl transition-all cursor-pointer flex-shrink-0">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Testimoni
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-auto admin-table-shell admin-table-scroll max-h-[600px]">
            <table class="admin-table">
                <thead>
                    <tr class="admin-table-head">
                        <th class="admin-table-head w-16">No.</th>
                        <th class="admin-table-head">Nama Pelanggan</th>
                        <th class="admin-table-head">Pesan</th>
                        <th class="admin-table-head">Rating</th>
                        <th class="admin-table-head">Waktu Ditambah</th>
                        <th class="admin-table-head">Status</th>
                        <th class="admin-table-head text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-watt-border">
                    @forelse($testimonials as $index => $testimonial)
                    <tr class="admin-table-row">
                        <td class="py-3.5 text-center text-sm font-medium text-watt-text-sec">{{ $index + 1 }}</td>
                        <td class="py-3.5 font-semibold text-white">{{ $testimonial->customer_name }}</td>
                        <td class="py-3.5 text-xs text-watt-text-sec max-w-xs">
                            <span class="line-clamp-2">{{ $testimonial->message }}</span>
                        </td>
                        <td class="py-3.5">
                            <div class="flex items-center gap-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-3.5 h-3.5 {{ $i <= $testimonial->rating ? 'text-yellow-400 fill-yellow-400' : 'fill-watt-border text-watt-border' }}" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                @endfor
                                <span class="ml-1 text-xs text-watt-text-sec font-mono font-bold">{{ $testimonial->rating }}/5</span>
                            </div>
                        </td>
                        <td class="py-3.5 text-xs text-watt-text-sec">
                            <div class="flex flex-col">
                                <span>{{ $testimonial->created_at->format('d M Y') }}</span>
                                <span class="text-[10px] text-watt-text-sec/70">{{ $testimonial->created_at->format('H:i') }}</span>
                            </div>
                        </td>
                        <td class="py-3.5">
                            @if($testimonial->status)
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
                                    onclick="openTestimonialEditModal(this)"
                                    data-id="{{ $testimonial->id }}"
                                    data-customer-name="{{ e($testimonial->customer_name) }}"
                                    data-message="{{ e($testimonial->message) }}"
                                    data-rating="{{ $testimonial->rating }}"
                                    data-status="{{ $testimonial->status ? '1' : '0' }}"
                                    class="admin-action-btn admin-action-btn--edit">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </button>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')">
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
                            <i data-lucide="message-square" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
                            <p>Belum ada testimoni yang ditambahkan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ====== MODAL CREATE TESTIMONI ====== -->
<div id="modal-create-testimonial" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal('modal-create-testimonial')"></div>
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 class="text-base font-semibold text-white flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-4 h-4 text-watt-cyan"></i>Tambah Testimoni
            </h3>
            <button onclick="closeModal('modal-create-testimonial')" class="p-1.5 rounded-lg hover:bg-watt-hover text-watt-text-sec hover:text-white cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <form action="{{ route('admin.testimonials.store') }}" method="POST" class="flex flex-col flex-1 min-h-0">
            @csrf
            <input type="hidden" name="_form_type" value="create">
            <div class="admin-modal-body">
                <div class="space-y-1.5">
                    <label class="admin-field-label">Nama Pelanggan <span class="text-watt-red">*</span></label>
                    <input type="text" name="customer_name" value="{{ session('_form_type') === 'create' ? old('customer_name') : '' }}" required placeholder="Contoh: Budi Santoso"
                        class="admin-field @if(session('_form_type') === 'create') @error('customer_name') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror @endif">
                    @if(session('_form_type') === 'create')
                        @error('customer_name')
                            <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Pesan / Ulasan <span class="text-watt-red">*</span></label>
                    <textarea name="message" rows="4" required placeholder="Contoh: Proses top up sangat cepat!"
                        class="admin-textarea @if(session('_form_type') === 'create') @error('message') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror @endif">{{ session('_form_type') === 'create' ? old('message') : '' }}</textarea>
                    @if(session('_form_type') === 'create')
                        @error('message')
                            <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Rating <span class="text-watt-red">*</span></label>
                    <select name="rating" required class="admin-select">
                        <option value="">-- Pilih Rating --</option>
                        @for($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" {{ (session('_form_type') === 'create' && old('rating') == $i) ? 'selected' : '' }}>
                                {{ $i }} Bintang {{ str_repeat('⭐', $i) }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="status" value="1" id="create-testi-status" checked class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                    <label for="create-testi-status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Aktif</label>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" onclick="closeModal('modal-create-testimonial')" class="admin-button-secondary cursor-pointer">Batal</button>
                <button type="submit" class="admin-button-primary cursor-pointer">Simpan Testimoni</button>
            </div>
        </form>
    </div>
</div>

<!-- ====== MODAL EDIT TESTIMONI ====== -->
<div id="modal-edit-testimonial" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal('modal-edit-testimonial')"></div>
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 class="text-base font-semibold text-white flex items-center gap-2">
                <i data-lucide="edit-3" class="w-4 h-4 text-watt-cyan"></i>Edit Testimoni
            </h3>
            <button onclick="closeModal('modal-edit-testimonial')" class="p-1.5 rounded-lg hover:bg-watt-hover text-watt-text-sec hover:text-white cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <form id="form-edit-testimonial" action="" method="POST" class="flex flex-col flex-1 min-h-0">
            @csrf @method('PUT')
            <input type="hidden" name="_form_type" value="edit">
            <input type="hidden" name="_edit_id" id="edit-testi-hidden-id" value="">
            <div class="admin-modal-body">
                <div class="space-y-1.5">
                    <label class="admin-field-label">Nama Pelanggan <span class="text-watt-red">*</span></label>
                    <input type="text" id="edit-testi-name" name="customer_name" required placeholder="Nama pelanggan..."
                        value="{{ session('_form_type') === 'edit' ? old('customer_name') : '' }}"
                        class="admin-field @if(session('_form_type') === 'edit') @error('customer_name') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror @endif">
                    @if(session('_form_type') === 'edit')
                        @error('customer_name')
                            <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Pesan / Ulasan <span class="text-watt-red">*</span></label>
                    <textarea id="edit-testi-message" name="message" rows="4" required
                        class="admin-textarea @if(session('_form_type') === 'edit') @error('message') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror @endif">{{ session('_form_type') === 'edit' ? old('message') : '' }}</textarea>
                    @if(session('_form_type') === 'edit')
                        @error('message')
                            <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Rating <span class="text-watt-red">*</span></label>
                    <select id="edit-testi-rating" name="rating" required class="admin-select">
                        @for($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" {{ (session('_form_type') === 'edit' && old('rating') == $i) ? 'selected' : '' }}>
                                {{ $i }} Bintang {{ str_repeat('⭐', $i) }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="status" value="1" id="edit-testi-status" class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                    <label for="edit-testi-status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Aktif</label>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" onclick="closeModal('modal-edit-testimonial')" class="admin-button-secondary cursor-pointer">Batal</button>
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
function openTestimonialEditModal(btn) {
    const id = btn.dataset.id;
    document.getElementById('form-edit-testimonial').action = '{{ url("admin/testimonials") }}/' + id;
    document.getElementById('edit-testi-hidden-id').value = id;
    document.getElementById('edit-testi-name').value = btn.dataset.customerName;
    document.getElementById('edit-testi-message').value = btn.dataset.message;
    document.getElementById('edit-testi-rating').value = btn.dataset.rating;
    document.getElementById('edit-testi-status').checked = btn.dataset.status === '1';
    openModal('modal-edit-testimonial');
}
document.addEventListener('DOMContentLoaded', function() {
    @if($errors->any())
        @if(session('_form_type') === 'edit')
            document.body.style.overflow = 'hidden';
            document.getElementById('form-edit-testimonial').action = '{{ url("admin/testimonials") }}/{{ session("_edit_id") }}';
            document.getElementById('edit-testi-hidden-id').value = '{{ session("_edit_id") }}';
            document.getElementById('edit-testi-name').value = @json(old('customer_name') ?? '');
            document.getElementById('edit-testi-message').value = @json(old('message') ?? '');
            document.getElementById('edit-testi-rating').value = '{{ old("rating") }}';
            document.getElementById('edit-testi-status').checked = {{ old('status') ? 'true' : 'false' }};
            openModal('modal-edit-testimonial');
        @else
            openModal('modal-create-testimonial');
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
