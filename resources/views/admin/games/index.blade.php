@extends('admin.layout')

@section('page_title', 'Manajemen Game')

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
                <i data-lucide="gamepad-2" class="w-4 h-4 text-watt-cyan"></i>
                <span class="text-sm font-semibold text-white">Daftar Game <span class="font-mono text-xs text-watt-text-sec">({{ count($games) }})</span></span>
            </div>
            <button onclick="openModal('modal-create-game')" class="inline-flex items-center gap-1.5 bg-watt-cyan hover:opacity-90 text-watt-bg text-xs font-bold px-4 py-2.5 rounded-xl transition-all cursor-pointer flex-shrink-0">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Game
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-auto admin-table-shell admin-table-scroll max-h-[600px]">
            <table class="admin-table">
                <thead class="sticky top-0 z-10 bg-watt-surface">
                    <tr class="admin-table-head">
                        <th class="admin-table-head w-16">No.</th>
                        <th class="admin-table-head">Thumbnail</th>
                        <th class="admin-table-head">Nama Game</th>
                        <th class="admin-table-head">Slug</th>
                        <th class="admin-table-head">Waktu Ditambah</th>
                        <th class="admin-table-head">Status</th>
                        <th class="admin-table-head text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-watt-border">
                    @forelse($games as $index => $game)
                    <tr class="admin-table-row">
                        <td class="py-3.5 text-center text-sm font-medium text-watt-text-sec">{{ $index + 1 }}</td>
                        <td class="py-3.5">
                            @if($game->thumbnail && file_exists(public_path('img/' . $game->thumbnail)))
                                <img src="{{ asset('img/' . $game->thumbnail) }}" alt="{{ $game->name }}" class="w-11 h-11 rounded-xl object-cover border border-watt-border">
                            @else
                                <div class="w-11 h-11 rounded-xl bg-watt-cyan/10 flex items-center justify-center text-watt-cyan">
                                    <i data-lucide="gamepad-2" class="w-5 h-5"></i>
                                </div>
                            @endif
                        </td>
                        <td class="py-3.5 font-semibold text-white">{{ $game->name }}</td>
                        <td class="py-3.5 text-xs font-mono text-watt-text-sec">{{ $game->slug }}</td>
                        <td class="py-3.5 text-xs text-watt-text-sec">
                            <div class="flex flex-col">
                                <span>{{ $game->created_at->format('d M Y') }}</span>
                                <span class="text-[10px] text-watt-text-sec/70">{{ $game->created_at->format('H:i') }}</span>
                            </div>
                        </td>
                        <td class="py-3.5">
                            @if($game->status)
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
                                    onclick="openGameEditModal(this)"
                                    data-id="{{ $game->id }}"
                                    data-name="{{ e($game->name) }}"
                                    data-description="{{ e($game->description ?? '') }}"
                                    data-status="{{ $game->status ? '1' : '0' }}"
                                    data-thumbnail="{{ $game->thumbnail && file_exists(public_path('img/' . $game->thumbnail)) ? asset('img/' . $game->thumbnail) : '' }}"
                                    data-thumbnail-name="{{ $game->thumbnail ?? '' }}"
                                    data-banner="{{ $game->banner && file_exists(public_path('img/' . $game->banner)) ? asset('img/' . $game->banner) : '' }}"
                                    data-banner-name="{{ $game->banner ?? '' }}"
                                    class="admin-action-btn admin-action-btn--edit">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </button>
                                <form action="{{ route('admin.games.destroy', $game->id) }}" method="POST" onsubmit="return confirm('Hapus game \'{{ addslashes($game->name) }}\' beserta seluruh produknya?')">
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
                            <i data-lucide="gamepad-2" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
                            <p>Belum ada game yang ditambahkan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ====== MODAL CREATE GAME ====== -->
<div id="modal-create-game" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal('modal-create-game')"></div>
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 class="text-base font-semibold text-white flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-4 h-4 text-watt-cyan"></i>Tambah Game Baru
            </h3>
            <button onclick="closeModal('modal-create-game')" class="p-1.5 rounded-lg hover:bg-watt-hover text-watt-text-sec hover:text-white cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <form action="{{ route('admin.games.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1 min-h-0" onsubmit="this.querySelector('button[type=submit]').disabled = true;">
            @csrf
            <input type="hidden" name="_form_type" value="create">
            <div class="admin-modal-body">
                <div class="space-y-1.5">
                    <label class="admin-field-label">Nama Game <span class="text-watt-red">*</span></label>
                    <input type="text" name="name" value="{{ old('_form_type') === 'create' ? old('name') : '' }}" required placeholder="Contoh: Mobile Legends: Bang Bang"
                        class="admin-field @if(old('_form_type') === 'create') @error('name') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror @endif">
                    @if(old('_form_type') === 'create')
                        @error('name')
                            <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Deskripsi Singkat</label>
                    <textarea name="description" rows="3" placeholder="Deskripsi atau instruksi pengisian ID..."
                        class="admin-textarea @if(old('_form_type') === 'create') @error('description') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror @endif">{{ old('_form_type') === 'create' ? old('description') : '' }}</textarea>
                    @if(old('_form_type') === 'create')
                        @error('description')
                            <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="admin-field-label">Logo / Thumbnail</label>
                        <input type="file" name="thumbnail" accept="image/*"
                            class="admin-field @if(old('_form_type') === 'create') @error('thumbnail') border-watt-red @enderror @endif file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                        <p class="text-[10px] text-watt-text-sec">Rasio 1:1, maks. 2MB.</p>
                        @if(old('_form_type') === 'create')
                            @error('thumbnail')
                                <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                    <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        @endif
                    </div>
                    <div class="space-y-1.5">
                        <label class="admin-field-label">Banner Detail</label>
                        <input type="file" name="banner" accept="image/*"
                            class="admin-field @if(old('_form_type') === 'create') @error('banner') border-watt-red @enderror @endif file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                        <p class="text-[10px] text-watt-text-sec">Landscape, maks. 2MB.</p>
                        @if(old('_form_type') === 'create')
                            @error('banner')
                                <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                    <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="status" value="1" id="create-game-status" checked class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                    <label for="create-game-status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Game Aktif</label>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" onclick="closeModal('modal-create-game')" class="admin-button-secondary cursor-pointer">Batal</button>
                <button type="submit" class="admin-button-primary cursor-pointer">Simpan Game</button>
            </div>
        </form>
    </div>
</div>

<!-- ====== MODAL EDIT GAME ====== -->
<div id="modal-edit-game" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal('modal-edit-game')"></div>
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3 class="text-base font-semibold text-white flex items-center gap-2">
                <i data-lucide="edit-3" class="w-4 h-4 text-watt-cyan"></i>Edit Game
            </h3>
            <button onclick="closeModal('modal-edit-game')" class="p-1.5 rounded-lg hover:bg-watt-hover text-watt-text-sec hover:text-white cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <form id="form-edit-game" action="" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1 min-h-0" onsubmit="this.querySelector('button[type=submit]').disabled = true;">
            @csrf @method('PUT')
            <input type="hidden" name="_form_type" value="edit">
            <input type="hidden" name="_edit_id" id="edit-game-hidden-id" value="">
            <div class="admin-modal-body">
                <div class="space-y-1.5">
                    <label class="admin-field-label">Nama Game <span class="text-watt-red">*</span></label>
                    <input type="text" id="edit-game-name" name="name" required placeholder="Nama game..."
                        value="{{ old('_form_type') === 'edit' ? old('name') : '' }}"
                        class="admin-field @if(old('_form_type') === 'edit') @error('name') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror @endif">
                    @if(old('_form_type') === 'edit')
                        @error('name')
                            <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>
                <div class="space-y-1.5">
                    <label class="admin-field-label">Deskripsi Singkat</label>
                    <textarea id="edit-game-description" name="description" rows="3" placeholder="Deskripsi..."
                        class="admin-textarea @if(old('_form_type') === 'edit') @error('description') border-watt-red focus:border-watt-red focus:ring-watt-red @enderror @endif">{{ old('_form_type') === 'edit' ? old('description') : '' }}</textarea>
                    @if(old('_form_type') === 'edit')
                        @error('description')
                            <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    @endif
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="admin-field-label">Logo / Thumbnail Baru</label>
                        <div id="edit-game-thumb-preview" class="hidden mb-2 flex items-center gap-2 bg-watt-bg border border-watt-border p-2 rounded-xl">
                            <img id="edit-game-thumb-img" src="" alt="" class="w-10 h-10 rounded-lg object-cover">
                            <span id="edit-game-thumb-name" class="text-[10px] text-watt-text-sec font-mono truncate flex-1"></span>
                        </div>
                        <input type="file" name="thumbnail" accept="image/*"
                            class="admin-field @if(old('_form_type') === 'edit') @error('thumbnail') border-watt-red @enderror @endif file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                        <p class="text-[10px] text-watt-text-sec">Kosongkan jika tidak ingin mengganti.</p>
                        @if(old('_form_type') === 'edit')
                            @error('thumbnail')
                                <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                    <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        @endif
                    </div>
                    <div class="space-y-1.5">
                        <label class="admin-field-label">Banner Detail Baru</label>
                        <div id="edit-game-banner-preview" class="hidden mb-2 flex items-center gap-2 bg-watt-bg border border-watt-border p-2 rounded-xl">
                            <img id="edit-game-banner-img" src="" alt="" class="w-16 h-10 rounded-lg object-cover">
                            <span id="edit-game-banner-name" class="text-[10px] text-watt-text-sec font-mono truncate flex-1"></span>
                        </div>
                        <input type="file" name="banner" accept="image/*"
                            class="admin-field @if(old('_form_type') === 'edit') @error('banner') border-watt-red @enderror @endif file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                        <p class="text-[10px] text-watt-text-sec">Kosongkan jika tidak ingin mengganti.</p>
                        @if(old('_form_type') === 'edit')
                            @error('banner')
                                <p class="text-xs font-semibold text-watt-red mt-1 flex items-center gap-1">
                                    <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="status" value="1" id="edit-game-status" class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                    <label for="edit-game-status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Game Aktif</label>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" onclick="closeModal('modal-edit-game')" class="admin-button-secondary cursor-pointer">Batal</button>
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
function openGameEditModal(btn) {
    const id = btn.dataset.id;
    document.getElementById('form-edit-game').action = '{{ url("admin/games") }}/' + id;
    document.getElementById('edit-game-hidden-id').value = id;
    document.getElementById('edit-game-name').value = btn.dataset.name;
    document.getElementById('edit-game-description').value = btn.dataset.description || '';
    document.getElementById('edit-game-status').checked = btn.dataset.status === '1';

    const thumbPreview = document.getElementById('edit-game-thumb-preview');
    if (btn.dataset.thumbnail) {
        document.getElementById('edit-game-thumb-img').src = btn.dataset.thumbnail;
        document.getElementById('edit-game-thumb-name').textContent = btn.dataset.thumbnailName;
        thumbPreview.classList.remove('hidden');
    } else { thumbPreview.classList.add('hidden'); }

    const bannerPreview = document.getElementById('edit-game-banner-preview');
    if (btn.dataset.banner) {
        document.getElementById('edit-game-banner-img').src = btn.dataset.banner;
        document.getElementById('edit-game-banner-name').textContent = btn.dataset.bannerName;
        bannerPreview.classList.remove('hidden');
    } else { bannerPreview.classList.add('hidden'); }

    openModal('modal-edit-game');
}

document.addEventListener('DOMContentLoaded', function() {
    @if($errors->any())
        @if(old('_form_type') === 'edit')
            // Set up edit form for validation errors
            document.getElementById('form-edit-game').action = '{{ url("admin/games") }}/{{ old("_edit_id") }}';
            document.getElementById('edit-game-hidden-id').value = '{{ old("_edit_id") }}';
            document.getElementById('edit-game-name').value = @json(old('name') ?? '');
            document.getElementById('edit-game-description').value = @json(old('description') ?? '');
            document.getElementById('edit-game-status').checked = {{ old('status') ? 'true' : 'false' }};
            openModal('modal-edit-game');
        @else
            openModal('modal-create-game');
        @endif
        lucide.createIcons();
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















