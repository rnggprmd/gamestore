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
                @if($showPriceSort ?? false)
                    <option value="price_asc" {{ ($sort ?? '') === 'price_asc' ? 'selected' : '' }}>Harga ↑</option>
                    <option value="price_desc" {{ ($sort ?? '') === 'price_desc' ? 'selected' : '' }}>Harga ↓</option>
                @endif
                @if($showRatingSort ?? false)
                    <option value="rating_asc" {{ ($sort ?? '') === 'rating_asc' ? 'selected' : '' }}>Rating ↑</option>
                    <option value="rating_desc" {{ ($sort ?? '') === 'rating_desc' ? 'selected' : '' }}>Rating ↓</option>
                @endif
                @if($showOrderSort ?? false)
                    <option value="order" {{ ($sort ?? '') === 'order' ? 'selected' : '' }}>Urutan</option>
                @endif
            </select>
        </div>

        <!-- Rating Filter (Optional) -->
        @if($showRatingFilter ?? false)
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
        @endif

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
        <slot name="header"></slot>
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

    <!-- Table Slot -->
    <slot name="table"></slot>
</div>

<script>
let searchTimeout;
function autoSubmitForm(button) {
    clearTimeout(searchTimeout);
    const form = button.closest('.search-filter-form');
    searchTimeout = setTimeout(() => {
        form.submit();
    }, 500);
}
</script>
