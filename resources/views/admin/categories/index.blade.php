@extends('admin.layout')

@section('page_title', 'Kategori Produk')

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
        
        <!-- Search & Filter -->
        <form method="GET" class="search-filter-form grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-end pb-4 border-b border-watt-border">
            <!-- Search Input -->
            <div class="sm:col-span-2 lg:col-span-1">
                <label class="admin-field-label text-xs mb-1.5">🔍 Cari</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Cari kategori..." autocomplete="off"
                    class="admin-field text-sm h-9 py-2"
                    onkeyup="autoSubmitForm(this)">
            </div>

            <!-- Status Filter -->
            <div>
                <label class="admin-field-label text-xs mb-1.5">Status</label>
                <select name="status" class="admin-field text-sm h-9 py-2" onchange="autoSubmitForm(this)">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <!-- Sort Filter -->
            <div>
                <label class="admin-field-label text-xs mb-1.5">Urutkan</label>
                <select name="sort" class="admin-field text-sm h-9 py-2" onchange="autoSubmitForm(this)">
                    <option value="latest" {{ (request('sort') ?? 'latest') === 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Nama A-Z</option>
                </select>
            </div>

            <!-- Reset Button -->
            <div>
                <a href="{{ route('admin.categories.index') }}" class="admin-button-secondary w-full text-xs px-3 py-2 flex items-center justify-center gap-2 border border-watt-border text-watt-text-sec hover:bg-watt-hover rounded-lg transition h-9">
                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                    <span>Reset</span>
                </a>
            </div>
        </form>

        <!-- Header with Add Button -->
        <div class="flex items-center justify-between pt-2">
            <div class="flex items-center gap-2">
                <i data-lucide="folder" class="w-4 h-4 text-watt-cyan"></i>
                <span class="text-sm font-semibold text-white">Daftar Kategori <span class="font-mono text-xs text-watt-text-sec">({{ $categories->total() }})</span></span>
            </div>
            <button onclick="openModal('modal-create-category')" class="inline-flex items-center gap-1.5 bg-watt-cyan hover:opacity-90 text-watt-bg text-xs font-bold px-4 py-2.5 rounded-xl transition-all cursor-pointer flex-shrink-0">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Kategori
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-auto admin-table-shell admin-table-scroll max-h-[600px]">
            <table class="admin-table">
                <thead>
                    <tr class="admin-table-head">
                        <th class="admin-table-head w-16">No.</th>
                        <th class="admin-table-head">Nama Kategori</th>
                        <th class="admin-table-head">Slug</th>
                        <th class="admin-table-head">Deskripsi</th>
                        <th class="admin-table-head text-center">Jumlah Produk</th>
                        <th class="admin-table-head">Waktu Ditambah</th>
                        <th class="admin-table-head">Status</th>
                        <th class="admin-table-head text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-watt-border">
                    @forelse($categories as $index => $category)
                    <tr class="admin-table-row">
                        <td class="py-3.5 text-center text-sm font-medium text-watt-text-sec">{{ $index + 1 }}</td>
                        <td class="py-3.5 font-semibold text-white">{{ $category->name }}</td>
                        <td class="py-3.5 text-xs font-mono text-watt-text-sec">{{ $category->slug }}</td>
                        <td class="py-3.5 text-watt-text-sec text-sm max-w-xs truncate">
                            {{ $category->description ? Str::limit($category->description, 50) : '-' }}
                        </td>
                        <td class="py-3.5 text-center">
                            <span class="px-2 py-0.5 rounded-lg bg-watt-hover text-watt-text-sec text-xs font-medium">
                                {{ $category->products_count ?? 0 }}
                            </span>
                        </td>
                        <td class="py-3.5 text-xs text-watt-text-sec">
                            <div class="flex flex-col">
                                <span>{{ $category->created_at->format('d M Y') }}</span>
                                <span class="text-[10px] text-watt-text-sec/70">{{ $category->created_at->format('H:i') }}</span>
                            </div>
                        </td>
                        <td class="py-3.5">
                            @if($category->status)
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
                                    onclick="openCategoryEditModal(this)"
                                    data-id="{{ $category->id }}"
                                    data-name="{{ e($category->name) }}"
                                    data-slug="{{ e($category->slug) }}"
                                    data-description="{{ e($category->description ?? '') }}"
                                    data-status="{{ $category->status ? '1' : '0' }}"
                                    class="admin-action-btn admin-action-btn--edit">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </button>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori \'{{ addslashes($category->name) }}\'?')">
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
                        <td colspan="8" class="py-16 text-center text-watt-text-sec text-xs">
                            <i data-lucide="folder" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
                            <p>Belum ada kategori yang ditambahkan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 px-1">
            {{ $categories->links() }}
        </div>
    </div>
</div>

<!-- ====== MODAL CREATE KATEGORI ====== -->
<div id="modal-create-category" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal('modal-create-category')"></div>
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 class="text-base font-semibold text-white flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-4 h-4 text-watt-cyan"></i>Tambah Kategori Baru
            </h3>
            <button onclick="closeModal('modal-create-category')" class="p-1.5 rounded-lg hover:bg-watt-hover text-watt-text-sec hover:text-white cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <form action="{{ route('admin.categories.store') }}" method="POST" class="flex flex-col flex-1 min-h-0">
            @csrf
            <input type="hidden" name="_form_type" value="create">
            <div class="admin-modal-body">
                <div class="space-y-1.5">
                    <label class="admin-field-label">Nama Kategori <span class="text-watt-red">*</span></label>
                    <input type="text" name="name" value="{{ session('_form_type') === 'create' ? old('name') : '' }}" required placeholder="Contoh: Diamond atau Weekly Pass"
                        class="admin-field @if(session('_form_type') === 'create') @error('name') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror @endif">
                    @if(session('_form_type') === 'create')
                        @error('name')
                            <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Slug (Opsional)</label>
                    <input type="text" name="slug" value="{{ session('_form_type') === 'create' ? old('slug') : '' }}" placeholder="Auto-generate dari nama jika kosong"
                        class="admin-field font-mono @if(session('_form_type') === 'create') @error('slug') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror @endif">
                    @if(session('_form_type') === 'create')
                        @error('slug')
                            <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Deskripsi (Opsional)</label>
                    <textarea name="description" rows="2" placeholder="Deskripsi opsional..."
                        class="admin-textarea">{{ session('_form_type') === 'create' ? old('description') : '' }}</textarea>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="status" value="1" id="create-category-status" checked class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                    <label for="create-category-status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Kategori Aktif</label>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" onclick="closeModal('modal-create-category')" class="admin-button-secondary cursor-pointer">Batal</button>
                <button type="submit" class="admin-button-primary cursor-pointer">Simpan Kategori</button>
            </div>
        </form>
    </div>
</div>

<!-- ====== MODAL EDIT KATEGORI ====== -->
<div id="modal-edit-category" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal('modal-edit-category')"></div>
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 class="text-base font-semibold text-white flex items-center gap-2">
                <i data-lucide="edit-3" class="w-4 h-4 text-watt-cyan"></i>Edit Kategori
            </h3>
            <button onclick="closeModal('modal-edit-category')" class="p-1.5 rounded-lg hover:bg-watt-hover text-watt-text-sec hover:text-white cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <form id="form-edit-category" action="" method="POST" class="flex flex-col flex-1 min-h-0">
            @csrf @method('PUT')
            <input type="hidden" name="_form_type" value="edit">
            <input type="hidden" name="_edit_id" id="edit-category-hidden-id" value="">
            <div class="admin-modal-body">
                <div class="space-y-1.5">
                    <label class="admin-field-label">Nama Kategori <span class="text-watt-red">*</span></label>
                    <input type="text" id="edit-category-name" name="name" required placeholder="Nama kategori..."
                        value="{{ session('_form_type') === 'edit' ? old('name') : '' }}"
                        class="admin-field @if(session('_form_type') === 'edit') @error('name') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror @endif">
                    @if(session('_form_type') === 'edit')
                        @error('name')
                            <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Slug</label>
                    <input type="text" id="edit-category-slug" name="slug" placeholder="Slug kategori..."
                        value="{{ session('_form_type') === 'edit' ? old('slug') : '' }}"
                        class="admin-field font-mono @if(session('_form_type') === 'edit') @error('slug') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror @endif">
                    @if(session('_form_type') === 'edit')
                        @error('slug')
                            <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Deskripsi (Opsional)</label>
                    <textarea id="edit-category-description" name="description" rows="2"
                        class="admin-textarea">{{ session('_form_type') === 'edit' ? old('description') : '' }}</textarea>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="status" value="1" id="edit-category-status" class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                    <label for="edit-category-status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Kategori Aktif</label>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" onclick="closeModal('modal-edit-category')" class="admin-button-secondary cursor-pointer">Batal</button>
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
function openCategoryEditModal(btn) {
    const id = btn.dataset.id;
    document.getElementById('form-edit-category').action = '{{ url("admin/categories") }}/' + id;
    document.getElementById('edit-category-hidden-id').value = id;
    document.getElementById('edit-category-name').value = btn.dataset.name;
    document.getElementById('edit-category-slug').value = btn.dataset.slug;
    document.getElementById('edit-category-description').value = btn.dataset.description || '';
    document.getElementById('edit-category-status').checked = btn.dataset.status === '1';

    openModal('modal-edit-category');
}

document.addEventListener('DOMContentLoaded', function() {
    @if($errors->any())
        @if(session('_form_type') === 'edit')
            document.body.style.overflow = 'hidden';
            document.getElementById('form-edit-category').action = '{{ url("admin/categories") }}/{{ session("_edit_id") }}';
            document.getElementById('edit-category-hidden-id').value = '{{ session("_edit_id") }}';
            document.getElementById('edit-category-name').value = @json(old('name') ?? '');
            document.getElementById('edit-category-slug').value = @json(old('slug') ?? '');
            document.getElementById('edit-category-description').value = @json(old('description') ?? '');
            document.getElementById('edit-category-status').checked = {{ old('status') ? 'true' : 'false' }};
            openModal('modal-edit-category');
        @else
            openModal('modal-create-category');
        @endif

        // Re-render Lucide icons
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