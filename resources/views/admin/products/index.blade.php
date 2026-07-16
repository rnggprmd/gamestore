@extends('admin.layout')

@section('page_title', 'Manajemen Produk')

@section('content')
<div class="space-y-6">
    <div class="admin-form-card p-5 space-y-6">
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
                    <option value="price_asc" {{ ($sort ?? '') === 'price_asc' ? 'selected' : '' }}>Harga ↑</option>
                    <option value="price_desc" {{ ($sort ?? '') === 'price_desc' ? 'selected' : '' }}>Harga ↓</option>
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

        <!-- Header -->
        <div class="flex items-center justify-between pt-2">
            <h3 class="text-base font-bold text-white flex items-center gap-2">
                <i data-lucide="package" class="w-4 h-4 text-watt-cyan"></i>
                Daftar Produk
                <span class="font-mono text-sm text-watt-text-sec">({{ $products->total() }})</span>
            </h3>
            <button onclick="openModal('modal-create-product')" class="inline-flex items-center gap-1.5 bg-watt-cyan hover:opacity-90 text-watt-bg text-xs font-bold px-4 py-2.5 rounded-xl transition-all cursor-pointer">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Produk
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-auto admin-table-shell admin-table-scroll max-h-[600px]">
            <table class="admin-table">
                <thead>
                    <tr class="admin-table-head">
                        <th class="admin-table-head">Game</th>
                        <th class="admin-table-head">Nama Produk</th>
                        <th class="admin-table-head">Kategori</th>
                        <th class="admin-table-head text-right">Harga</th>
                        <th class="admin-table-head">Status</th>
                        <th class="admin-table-head text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-watt-border">
                    @forelse($products as $product)
                    <tr class="admin-table-row">
                        <td class="py-3.5 font-semibold text-white">{{ $product->game->name ?? '-' }}</td>
                        <td class="py-3.5 text-watt-text-sec">{{ $product->name }}</td>
                        <td class="py-3.5">
                            <span class="px-2 py-0.5 rounded-lg bg-watt-hover text-watt-text-sec text-xs font-medium">{{ $product->category->name ?? '-' }}</span>
                        </td>
                        <td class="py-3.5 text-right font-bold text-watt-cyan font-mono text-xs">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        <td class="py-3.5">
                            @if($product->status)
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
                                    onclick="openProductEditModal(this)"
                                    data-id="{{ $product->id }}"
                                    data-game-id="{{ $product->game_id }}"
                                    data-category-id="{{ $product->category_id }}"
                                    data-name="{{ e($product->name) }}"
                                    data-price="{{ (int)$product->price }}"
                                    data-description="{{ e($product->description ?? '') }}"
                                    data-status="{{ $product->status ? '1' : '0' }}"
                                    data-image="{{ $product->image && file_exists(public_path('img/' . $product->image)) ? asset('img/' . $product->image) : '' }}"
                                    data-image-name="{{ $product->image ?? '' }}"
                                    class="admin-action-btn admin-action-btn--edit">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </button>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk \'{{ addslashes($product->name) }}\'?')">
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
                        <td colspan="6" class="py-16 text-center text-watt-text-sec text-xs">
                            <i data-lucide="package" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
                            <p>Belum ada produk yang ditambahkan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 px-1">
            {{ $products->links() }}
        </div>
    </div>
</div>

<!-- ====== MODAL CREATE PRODUK ====== -->
<div id="modal-create-product" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal('modal-create-product')"></div>
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 class="text-base font-semibold text-white flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-4 h-4 text-watt-cyan"></i>Tambah Produk Baru
            </h3>
            <button onclick="closeModal('modal-create-product')" class="p-1.5 rounded-lg hover:bg-watt-hover text-watt-text-sec hover:text-white cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1 min-h-0">
            @csrf
            <input type="hidden" name="_form_type" value="create">
            <div class="admin-modal-body">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="admin-field-label">Game <span class="text-watt-red">*</span></label>
                        <select name="game_id" required class="admin-select">
                            <option value="">-- Pilih Game --</option>
                            @foreach($games as $game)
                                <option value="{{ $game->id }}" {{ (old('_form_type') === 'create' && old('game_id') == $game->id) ? 'selected' : '' }}>{{ $game->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="admin-field-label">Kategori <span class="text-watt-red">*</span></label>
                        <select name="category_id" required class="admin-select">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ (old('_form_type') === 'create' && old('category_id') == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Nama Produk <span class="text-watt-red">*</span></label>
                    <input type="text" name="name" value="{{ old('_form_type') === 'create' ? old('name') : '' }}" required placeholder="Contoh: Diamond 86 atau Weekly Pass"
                        class="admin-field">
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Harga (IDR) <span class="text-watt-red">*</span></label>
                    <input type="number" name="price" value="{{ old('_form_type') === 'create' ? old('price') : '' }}" required min="0" placeholder="Contoh: 28000"
                        class="admin-field font-mono">
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Deskripsi (Opsional)</label>
                    <textarea name="description" rows="2" placeholder="Deskripsi opsional..."
                        class="admin-textarea">{{ old('_form_type') === 'create' ? old('description') : '' }}</textarea>
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Gambar Produk (Opsional)</label>
                    <input type="file" name="image" accept="image/*"
                        class="admin-field file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="status" value="1" id="create-product-status" checked class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                    <label for="create-product-status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Produk Aktif</label>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" onclick="closeModal('modal-create-product')" class="admin-button-secondary cursor-pointer">Batal</button>
                <button type="submit" class="admin-button-primary cursor-pointer">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>

<!-- ====== MODAL EDIT PRODUK ====== -->
<div id="modal-edit-product" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal('modal-edit-product')"></div>
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 class="text-base font-semibold text-white flex items-center gap-2">
                <i data-lucide="edit-3" class="w-4 h-4 text-watt-cyan"></i>Edit Produk
            </h3>
            <button onclick="closeModal('modal-edit-product')" class="p-1.5 rounded-lg hover:bg-watt-hover text-watt-text-sec hover:text-white cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <form id="form-edit-product" action="" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1 min-h-0">
            @csrf @method('PUT')
            <input type="hidden" name="_form_type" value="edit">
            <input type="hidden" name="_edit_id" id="edit-product-hidden-id" value="">
            <div class="admin-modal-body">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="admin-field-label">Game <span class="text-watt-red">*</span></label>
                        <select id="edit-product-game" name="game_id" required class="admin-select">
                            @foreach($games as $game)
                                <option value="{{ $game->id }}"
                                    {{ (old('_form_type') === 'edit' && old('game_id') == $game->id) ? 'selected' : '' }}>{{ $game->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="admin-field-label">Kategori <span class="text-watt-red">*</span></label>
                        <select id="edit-product-category" name="category_id" required class="admin-select">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ (old('_form_type') === 'edit' && old('category_id') == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Nama Produk <span class="text-watt-red">*</span></label>
                    <input type="text" id="edit-product-name" name="name" required placeholder="Nama produk..."
                        value="{{ old('_form_type') === 'edit' ? old('name') : '' }}"
                        class="admin-field">
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Harga (IDR) <span class="text-watt-red">*</span></label>
                    <input type="number" id="edit-product-price" name="price" required min="0"
                        value="{{ old('_form_type') === 'edit' ? old('price') : '' }}"
                        class="admin-field font-mono">
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Deskripsi (Opsional)</label>
                    <textarea id="edit-product-description" name="description" rows="2"
                        class="admin-textarea">{{ old('_form_type') === 'edit' ? old('description') : '' }}</textarea>
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Gambar Baru (Opsional)</label>
                    <div id="edit-product-img-preview" class="hidden mb-2 flex items-center gap-2 bg-watt-bg border border-watt-border p-2 rounded-xl">
                        <img id="edit-product-img" src="" alt="" class="w-10 h-10 rounded-lg object-cover">
                        <span id="edit-product-img-name" class="text-[10px] text-watt-text-sec font-mono truncate flex-1"></span>
                    </div>
                    <input type="file" name="image" accept="image/*"
                        class="admin-field file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                    <p class="text-[10px] text-watt-text-sec">Kosongkan jika tidak ingin mengganti.</p>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="status" value="1" id="edit-product-status" class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                    <label for="edit-product-status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Produk Aktif</label>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" onclick="closeModal('modal-edit-product')" class="admin-button-secondary cursor-pointer">Batal</button>
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
function openProductEditModal(btn) {
    const id = btn.dataset.id;
    document.getElementById('form-edit-product').action = '{{ url("admin/products") }}/' + id;
    document.getElementById('edit-product-hidden-id').value = id;
    document.getElementById('edit-product-game').value = btn.dataset.gameId;
    document.getElementById('edit-product-category').value = btn.dataset.categoryId;
    document.getElementById('edit-product-name').value = btn.dataset.name;
    document.getElementById('edit-product-price').value = btn.dataset.price;
    document.getElementById('edit-product-description').value = btn.dataset.description || '';
    document.getElementById('edit-product-status').checked = btn.dataset.status === '1';

    const imgPreview = document.getElementById('edit-product-img-preview');
    if (btn.dataset.image) {
        document.getElementById('edit-product-img').src = btn.dataset.image;
        document.getElementById('edit-product-img-name').textContent = btn.dataset.imageName;
        imgPreview.classList.remove('hidden');
    } else { imgPreview.classList.add('hidden'); }

    openModal('modal-edit-product');
}
@if($errors->any())
document.addEventListener('DOMContentLoaded', function() {
    @if(old('_form_type') === 'edit')
        openModal('modal-edit-product');
        document.getElementById('form-edit-product').action = '{{ url("admin/products") }}/{{ old("_edit_id") }}';
        document.getElementById('edit-product-hidden-id').value = '{{ old("_edit_id") }}';
        document.getElementById('edit-product-game').value = '{{ old("game_id") }}';
        document.getElementById('edit-product-category').value = '{{ old("category_id") }}';
        document.getElementById('edit-product-name').value = @json(old('name') ?? '');
        document.getElementById('edit-product-price').value = '{{ old("price") }}';
        document.getElementById('edit-product-description').value = @json(old('description') ?? '');
        document.getElementById('edit-product-status').checked = {{ old('status') ? 'true' : 'false' }};
    @else
        openModal('modal-create-product');
    @endif
});
@endif

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
