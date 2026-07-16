@extends('admin.layout')

@section('page_title', 'Manajemen Game')

@section('content')
<div class="space-y-6">
    <div class="bg-watt-surface border border-watt-border rounded-[16px] p-5 space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-white flex items-center gap-2">
                <i data-lucide="gamepad-2" class="w-4 h-4 text-watt-cyan"></i>
                Daftar Game
                <span class="font-mono text-sm text-watt-text-sec">({{ count($games) }})</span>
            </h3>
            <button onclick="openModal('modal-create-game')" class="inline-flex items-center gap-1.5 bg-watt-cyan hover:opacity-90 text-watt-bg text-xs font-bold px-4 py-2.5 rounded-xl transition-all cursor-pointer">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Game
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
                <thead class="sticky top-0 z-10 bg-watt-surface">
                    <tr class="text-xs font-bold uppercase text-watt-text-sec border-b border-watt-border">
                        <th class="pb-3 pt-1 bg-watt-surface">Thumbnail</th>
                        <th class="pb-3 pt-1 bg-watt-surface">Nama Game</th>
                        <th class="pb-3 pt-1 bg-watt-surface">Slug</th>
                        <th class="pb-3 pt-1 bg-watt-surface">Status</th>
                        <th class="pb-3 pt-1 text-right bg-watt-surface">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-watt-border">
                    @forelse($games as $game)
                    <tr class="hover:bg-watt-hover transition-colors">
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
                        <td class="py-3.5">
                            @if($game->status)
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
                                    onclick="openGameEditModal(this)"
                                    data-id="{{ $game->id }}"
                                    data-name="{{ e($game->name) }}"
                                    data-description="{{ e($game->description ?? '') }}"
                                    data-status="{{ $game->status ? '1' : '0' }}"
                                    data-thumbnail="{{ $game->thumbnail && file_exists(public_path('img/' . $game->thumbnail)) ? asset('img/' . $game->thumbnail) : '' }}"
                                    data-thumbnail-name="{{ $game->thumbnail ?? '' }}"
                                    data-banner="{{ $game->banner && file_exists(public_path('img/' . $game->banner)) ? asset('img/' . $game->banner) : '' }}"
                                    data-banner-name="{{ $game->banner ?? '' }}"
                                    class="p-2 rounded-lg bg-watt-hover hover:bg-watt-cyan/10 hover:text-watt-cyan text-watt-text-sec transition-all cursor-pointer">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </button>
                                <form action="{{ route('admin.games.destroy', $game->id) }}" method="POST" onsubmit="return confirm('Hapus game \'{{ addslashes($game->name) }}\' beserta seluruh produknya?')">
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
    <div class="relative w-full max-w-xl bg-watt-surface border border-watt-border rounded-[16px] p-6 shadow-2xl space-y-5 overflow-y-auto max-h-[90vh]">
        <div class="flex items-center justify-between border-b border-watt-border pb-4">
            <h3 class="text-base font-semibold text-white flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-4 h-4 text-watt-cyan"></i>Tambah Game Baru
            </h3>
            <button onclick="closeModal('modal-create-game')" class="p-1.5 rounded-lg hover:bg-watt-hover text-watt-text-sec hover:text-white cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <form action="{{ route('admin.games.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="_form_type" value="create">
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Nama Game <span class="text-watt-red">*</span></label>
                <input type="text" name="name" value="{{ old('_form_type') === 'create' ? old('name') : '' }}" required placeholder="Contoh: Mobile Legends: Bang Bang"
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Deskripsi Singkat</label>
                <textarea name="description" rows="3" placeholder="Deskripsi atau instruksi pengisian ID..."
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors resize-none">{{ old('_form_type') === 'create' ? old('description') : '' }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Logo / Thumbnail</label>
                    <input type="file" name="thumbnail" accept="image/*"
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-3 py-2 text-sm text-watt-text-sec file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                    <p class="text-[10px] text-watt-text-sec">Rasio 1:1, maks. 2MB.</p>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Banner Detail</label>
                    <input type="file" name="banner" accept="image/*"
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-3 py-2 text-sm text-watt-text-sec file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                    <p class="text-[10px] text-watt-text-sec">Landscape, maks. 2MB.</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" id="create-game-status" checked class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                <label for="create-game-status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Game Aktif</label>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-watt-border">
                <button type="button" onclick="closeModal('modal-create-game')" class="px-5 py-2.5 rounded-xl bg-watt-hover hover:bg-[#333] text-watt-text-sec hover:text-white font-semibold text-xs transition-all cursor-pointer">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-watt-cyan hover:opacity-90 text-watt-bg font-bold text-xs transition-all cursor-pointer">Simpan Game</button>
            </div>
        </form>
    </div>
</div>

<!-- ====== MODAL EDIT GAME ====== -->
<div id="modal-edit-game" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal('modal-edit-game')"></div>
    <div class="relative w-full max-w-xl bg-watt-surface border border-watt-border rounded-[16px] p-6 shadow-2xl space-y-5 overflow-y-auto max-h-[90vh]">
        <div class="flex items-center justify-between border-b border-watt-border pb-4">
            <h3 class="text-base font-semibold text-white flex items-center gap-2">
                <i data-lucide="edit-3" class="w-4 h-4 text-watt-cyan"></i>Edit Game
            </h3>
            <button onclick="closeModal('modal-edit-game')" class="p-1.5 rounded-lg hover:bg-watt-hover text-watt-text-sec hover:text-white cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <form id="form-edit-game" action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            <input type="hidden" name="_form_type" value="edit">
            <input type="hidden" name="_edit_id" id="edit-game-hidden-id" value="">
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Nama Game <span class="text-watt-red">*</span></label>
                <input type="text" id="edit-game-name" name="name" required placeholder="Nama game..."
                    value="{{ old('_form_type') === 'edit' ? old('name') : '' }}"
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
            </div>
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Deskripsi Singkat</label>
                <textarea id="edit-game-description" name="description" rows="3" placeholder="Deskripsi..."
                    class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors resize-none">{{ old('_form_type') === 'edit' ? old('description') : '' }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Logo / Thumbnail Baru</label>
                    <div id="edit-game-thumb-preview" class="hidden mb-2 flex items-center gap-2 bg-watt-bg border border-watt-border p-2 rounded-xl">
                        <img id="edit-game-thumb-img" src="" alt="" class="w-10 h-10 rounded-lg object-cover">
                        <span id="edit-game-thumb-name" class="text-[10px] text-watt-text-sec font-mono truncate flex-1"></span>
                    </div>
                    <input type="file" name="thumbnail" accept="image/*"
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-3 py-2 text-sm text-watt-text-sec file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                    <p class="text-[10px] text-watt-text-sec">Kosongkan jika tidak ingin mengganti.</p>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Banner Detail Baru</label>
                    <div id="edit-game-banner-preview" class="hidden mb-2 flex items-center gap-2 bg-watt-bg border border-watt-border p-2 rounded-xl">
                        <img id="edit-game-banner-img" src="" alt="" class="w-16 h-10 rounded-lg object-cover">
                        <span id="edit-game-banner-name" class="text-[10px] text-watt-text-sec font-mono truncate flex-1"></span>
                    </div>
                    <input type="file" name="banner" accept="image/*"
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-3 py-2 text-sm text-watt-text-sec file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                    <p class="text-[10px] text-watt-text-sec">Kosongkan jika tidak ingin mengganti.</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" id="edit-game-status" class="rounded border-watt-border bg-watt-bg text-watt-cyan focus:ring-watt-cyan">
                <label for="edit-game-status" class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider select-none cursor-pointer">Game Aktif</label>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-watt-border">
                <button type="button" onclick="closeModal('modal-edit-game')" class="px-5 py-2.5 rounded-xl bg-watt-hover hover:bg-[#333] text-watt-text-sec hover:text-white font-semibold text-xs transition-all cursor-pointer">Batal</button>
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

@if($errors->any())
document.addEventListener('DOMContentLoaded', function() {
    @if(old('_form_type') === 'edit')
        openModal('modal-edit-game');
        document.getElementById('form-edit-game').action = '{{ url("admin/games") }}/{{ old("_edit_id") }}';
        document.getElementById('edit-game-hidden-id').value = '{{ old("_edit_id") }}';
        document.getElementById('edit-game-name').value = @json(old('name') ?? '');
        document.getElementById('edit-game-description').value = @json(old('description') ?? '');
        document.getElementById('edit-game-status').checked = {{ old('status') ? 'true' : 'false' }};
    @else
        openModal('modal-create-game');
    @endif
});
@endif
</script>
@endsection
