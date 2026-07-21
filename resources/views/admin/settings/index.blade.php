@extends('admin.layout')

@section('page_title', 'Pengaturan Website')

@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- LEFT: Identitas & Branding --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Identitas Toko --}}
            <div class="admin-form-card p-6 space-y-6">
                <h3 class="text-sm font-bold text-white flex items-center gap-2 border-b border-watt-border pb-4">
                    <i data-lucide="store" class="w-4 h-4 text-watt-cyan"></i>
                    Identitas Toko
                </h3>

                <div class="space-y-1.5">
                    <label class="admin-field-label">Nama Toko <span class="text-watt-red">*</span></label>
                    <input type="text" name="store_name" value="{{ old('store_name', $setting->store_name) }}" required
                        class="admin-field">
                </div>

                {{-- Logo Upload --}}
                <div class="space-y-1.5">
                    <label class="admin-field-label">Logo Toko</label>
                    @if($setting->logo && file_exists(public_path('img/' . $setting->logo)))
                        <div class="mb-2 flex items-center gap-3 bg-watt-bg border border-watt-border p-3 rounded-xl">
                            <img src="{{ asset('img/' . $setting->logo) }}" alt="Logo" class="h-10 w-auto object-contain">
                            <span class="text-[10px] text-watt-text-sec font-mono">{{ $setting->logo }}</span>
                        </div>
                    @endif
                    <input type="file" name="logo" accept="image/*"
                        class="admin-field file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                </div>

                {{-- Favicon Upload --}}
                <div class="space-y-1.5">
                    <label class="admin-field-label">Favicon (ICO/PNG)</label>
                    @if($setting->favicon && file_exists(public_path('img/' . $setting->favicon)))
                        <div class="mb-2 flex items-center gap-3 bg-watt-bg border border-watt-border p-3 rounded-xl">
                            <img src="{{ asset('img/' . $setting->favicon) }}" alt="Favicon" class="h-8 w-8 object-contain">
                            <span class="text-[10px] text-watt-text-sec font-mono">{{ $setting->favicon }}</span>
                        </div>
                    @endif
                    <input type="file" name="favicon" accept="image/*,.ico"
                        class="admin-field file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="admin-field-label">Alamat Toko</label>
                        <textarea name="address" rows="2"
                            class="admin-textarea">{{ old('address', $setting->address) }}</textarea>
                    </div>
                    <div class="space-y-1.5">
                        <label class="admin-field-label">Jam Operasional</label>
                        <input type="text" name="operating_hours" value="{{ old('operating_hours', $setting->operating_hours) }}" placeholder="09:00 - 22:00 WIB"
                            class="admin-field">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="admin-field-label">Teks Footer</label>
                    <textarea name="footer" rows="2"
                        class="admin-textarea">{{ old('footer', $setting->footer) }}</textarea>
                </div>
            </div>

            {{-- SEO Meta --}}
            <div class="admin-form-card p-6 space-y-6">
                <h3 class="text-sm font-bold text-white flex items-center gap-2 border-b border-watt-border pb-4">
                    <i data-lucide="search" class="w-4 h-4 text-watt-cyan"></i>
                    SEO Meta
                </h3>

                <div class="space-y-1.5">
                    <label class="admin-field-label">Meta Description</label>
                    <textarea name="meta_description" rows="3" placeholder="Deskripsi singkat untuk hasil pencarian Google..."
                        class="admin-textarea">{{ old('meta_description', $setting->meta_description) }}</textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="admin-field-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $setting->meta_keywords) }}" placeholder="topup game, diamond mlbb, uc pubg, ..."
                        class="admin-field">
                    <p class="text-[10px] text-watt-text-sec">Pisahkan kata kunci dengan koma.</p>
                </div>
            </div>
        </div>

        {{-- RIGHT: Kontak & Konten --}}
        <div class="space-y-6">

            {{-- Kontak --}}
            <div class="admin-form-card p-6 space-y-5">
                <h3 class="text-sm font-bold text-white flex items-center gap-2 border-b border-watt-border pb-4">
                    <i data-lucide="phone" class="w-4 h-4 text-watt-cyan"></i>
                    Kontak & Sosial Media
                </h3>

                <div class="space-y-1.5">
                    <label class="admin-field-label">Nomor WhatsApp Admin <span class="text-watt-red">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-watt-text-sec text-xs font-mono">+</span>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $setting->whatsapp) }}" required placeholder="628123456789"
                            class="admin-field pl-6 font-mono">
                    </div>
                    <p class="text-[10px] text-watt-text-sec">Format internasional tanpa +. Contoh: 628123456789</p>
                </div>

                <div class="space-y-1.5">
                    <label class="admin-field-label">Saluran WA (Testimoni)</label>
                    <input type="url" name="whatsapp_channel" value="{{ old('whatsapp_channel', $setting->whatsapp_channel) }}" placeholder="https://whatsapp.com/channel/..."
                        class="admin-field">
                </div>

                <div class="space-y-1.5">
                    <label class="admin-field-label">Instagram</label>
                    <input type="url" name="instagram" value="{{ old('instagram', $setting->instagram) }}" placeholder="https://instagram.com/..."
                        class="admin-field">
                </div>

                <div class="space-y-1.5">
                    <label class="admin-field-label">Facebook</label>
                    <input type="url" name="facebook" value="{{ old('facebook', $setting->facebook) }}" placeholder="https://facebook.com/..."
                        class="admin-field">
                </div>

                <div class="space-y-1.5">
                    <label class="admin-field-label">Discord</label>
                    <input type="url" name="discord" value="{{ old('discord', $setting->discord) }}" placeholder="https://discord.gg/..."
                        class="admin-field">
                </div>
            </div>

            {{-- WhatsApp Templates --}}
            <div class="admin-form-card p-6 space-y-5">
                <h3 class="text-sm font-bold text-white flex items-center gap-2 border-b border-watt-border pb-4">
                    <i data-lucide="message-circle" class="w-4 h-4 text-watt-cyan"></i>
                    Template Pesan WhatsApp
                </h3>

                <div class="space-y-1.5">
                    <label class="admin-field-label">Template: 1 Item</label>
                    <textarea name="whatsapp_template_single" rows="5" placeholder="*PESANAN - @{{STORE_NAME}}*
=================================
*Item yang dipesan:*

*Nama Game:* @{{GAME_NAME}}
*Produk:* @{{PRODUCT_NAME}}
*Username:* @{{USERNAME}}
*UID:* @{{UID}}
*Harga:* @{{PRICE}}

=================================
*TOTAL: @{{TOTAL}}*

Terima kasih sudah berbelanja!"
                        class="admin-textarea text-[11px] font-mono">{{ old('whatsapp_template_single', $setting->whatsapp_template_single) }}</textarea>
                    
                    <div class="flex flex-wrap gap-1.5 mt-2 bg-watt-bg/50 border border-watt-border/50 p-2.5 rounded-xl">
                        <span class="text-[10px] text-watt-text-sec w-full mb-1">Klik untuk memasukkan tag di posisi kursor:</span>
                        <button type="button" onclick="insertTag('whatsapp_template_single', '@{{STORE_NAME}}')" class="px-2 py-1 text-[10px] bg-watt-bg border border-watt-border rounded-lg text-watt-cyan hover:bg-watt-border transition cursor-pointer font-mono font-bold">+ @{{STORE_NAME}}</button>
                        <button type="button" onclick="insertTag('whatsapp_template_single', '@{{GAME_NAME}}')" class="px-2 py-1 text-[10px] bg-watt-bg border border-watt-border rounded-lg text-watt-cyan hover:bg-watt-border transition cursor-pointer font-mono font-bold">+ @{{GAME_NAME}}</button>
                        <button type="button" onclick="insertTag('whatsapp_template_single', '@{{PRODUCT_NAME}}')" class="px-2 py-1 text-[10px] bg-watt-bg border border-watt-border rounded-lg text-watt-cyan hover:bg-watt-border transition cursor-pointer font-mono font-bold">+ @{{PRODUCT_NAME}}</button>
                        <button type="button" onclick="insertTag('whatsapp_template_single', '@{{USERNAME}}')" class="px-2 py-1 text-[10px] bg-watt-bg border border-watt-border rounded-lg text-watt-cyan hover:bg-watt-border transition cursor-pointer font-mono font-bold">+ @{{USERNAME}}</button>
                        <button type="button" onclick="insertTag('whatsapp_template_single', '@{{UID}}')" class="px-2 py-1 text-[10px] bg-watt-bg border border-watt-border rounded-lg text-watt-cyan hover:bg-watt-border transition cursor-pointer font-mono font-bold">+ @{{UID}}</button>
                        <button type="button" onclick="insertTag('whatsapp_template_single', '@{{PRICE}}')" class="px-2 py-1 text-[10px] bg-watt-bg border border-watt-border rounded-lg text-watt-cyan hover:bg-watt-border transition cursor-pointer font-mono font-bold">+ @{{PRICE}}</button>
                        <button type="button" onclick="insertTag('whatsapp_template_single', '@{{TOTAL}}')" class="px-2 py-1 text-[10px] bg-watt-bg border border-watt-border rounded-lg text-watt-cyan hover:bg-watt-border transition cursor-pointer font-mono font-bold">+ @{{TOTAL}}</button>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="admin-field-label">Template: Multiple Items</label>
                    <textarea name="whatsapp_template_multiple" rows="5" placeholder="*PESANAN MULTI ITEM - @{{STORE_NAME}}*
=================================
*Detail Pesanan:*

@{{ITEMS}}

=================================
*TOTAL PEMBAYARAN: @{{TOTAL}}*
=================================

Mohon segera diproses pesanan ini. Terima kasih!"
                        class="admin-textarea text-[11px] font-mono">{{ old('whatsapp_template_multiple', $setting->whatsapp_template_multiple) }}</textarea>
                    
                    <div class="flex flex-wrap gap-1.5 mt-2 bg-watt-bg/50 border border-watt-border/50 p-2.5 rounded-xl">
                        <span class="text-[10px] text-watt-text-sec w-full mb-1">Klik untuk memasukkan tag di posisi kursor:</span>
                        <button type="button" onclick="insertTag('whatsapp_template_multiple', '@{{STORE_NAME}}')" class="px-2 py-1 text-[10px] bg-watt-bg border border-watt-border rounded-lg text-watt-cyan hover:bg-watt-border transition cursor-pointer font-mono font-bold">+ @{{STORE_NAME}}</button>
                        <button type="button" onclick="insertTag('whatsapp_template_multiple', '@{{ITEMS}}')" class="px-2 py-1 text-[10px] bg-watt-bg border border-watt-border rounded-lg text-watt-cyan hover:bg-watt-border transition cursor-pointer font-mono font-bold">+ @{{ITEMS}}</button>
                        <button type="button" onclick="insertTag('whatsapp_template_multiple', '@{{TOTAL}}')" class="px-2 py-1 text-[10px] bg-watt-bg border border-watt-border rounded-lg text-watt-cyan hover:bg-watt-border transition cursor-pointer font-mono font-bold">+ @{{TOTAL}}</button>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="admin-field-label">Template: Hubungi Admin</label>
                    <textarea name="whatsapp_contact_template" rows="4" placeholder="Halo @{{STORE_NAME}}, saya ingin bertanya tentang produk Anda.

Mohon bantu saya. Terima kasih! 🙏"
                        class="admin-textarea text-[11px] font-mono">{{ old('whatsapp_contact_template', $setting->whatsapp_contact_template) }}</textarea>
                    
                    <div class="flex flex-wrap gap-1.5 mt-2 bg-watt-bg/50 border border-watt-border/50 p-2.5 rounded-xl">
                        <span class="text-[10px] text-watt-text-sec w-full mb-1">Klik untuk memasukkan tag di posisi kursor:</span>
                        <button type="button" onclick="insertTag('whatsapp_contact_template', '@{{STORE_NAME}}')" class="px-2 py-1 text-[10px] bg-watt-bg border border-watt-border rounded-lg text-watt-cyan hover:bg-watt-border transition cursor-pointer font-mono font-bold">+ @{{STORE_NAME}}</button>
                    </div>
                </div>
            </div>

            {{-- Cara Order --}}
            <div class="admin-form-card p-6 space-y-5">
                <h3 class="text-sm font-bold text-white flex items-center gap-2 border-b border-watt-border pb-4">
                    <i data-lucide="youtube" class="w-4 h-4 text-watt-red"></i>
                    Konten Cara Order
                </h3>

                <div class="space-y-1.5">
                    <label class="admin-field-label">Link Video YouTube</label>
                    <input type="url" name="youtube_tutorial" value="{{ old('youtube_tutorial', $setting->youtube_tutorial) }}" placeholder="https://youtube.com/watch?v=..."
                        class="admin-field">
                    <p class="text-[10px] text-watt-text-sec">Video akan di-embed di halaman Cara Order.</p>
                </div>
            </div>

            {{-- Save Button --}}
            <button type="submit" class="admin-button-primary w-full text-sm cursor-pointer">
                <i data-lucide="save" class="w-5 h-5"></i>
                Simpan Semua Pengaturan
            </button>
        </div>

    </div>
</form>

<script>
    function insertTag(textareaName, tag) {
        const textarea = document.querySelector(`textarea[name="${textareaName}"]`);
        if (!textarea) return;
        
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const text = textarea.value;
        
        // Insert tag at cursor position
        textarea.value = text.substring(0, start) + tag + text.substring(end);
        
        // Focus and put cursor right after the inserted tag
        textarea.focus();
        textarea.selectionStart = textarea.selectionEnd = start + tag.length;
    }
</script>
@endsection
