@extends('admin.layout')

@section('page_title', 'Pengaturan Website')

@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- LEFT: Identitas & Branding --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Identitas Toko --}}
            <div class="bg-watt-surface border border-watt-border rounded-[16px] p-6 space-y-6">
                <h3 class="text-sm font-bold text-white flex items-center gap-2 border-b border-watt-border pb-4">
                    <i data-lucide="store" class="w-4 h-4 text-watt-cyan"></i>
                    Identitas Toko
                </h3>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Nama Toko <span class="text-watt-red">*</span></label>
                    <input type="text" name="store_name" value="{{ old('store_name', $setting->store_name) }}" required
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
                </div>

                {{-- Logo Upload --}}
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Logo Toko</label>
                    @if($setting->logo && file_exists(public_path('img/' . $setting->logo)))
                        <div class="mb-2 flex items-center gap-3 bg-watt-bg border border-watt-border p-3 rounded-xl">
                            <img src="{{ asset('img/' . $setting->logo) }}" alt="Logo" class="h-10 w-auto object-contain">
                            <span class="text-[10px] text-watt-text-sec font-mono">{{ $setting->logo }}</span>
                        </div>
                    @endif
                    <input type="file" name="logo" accept="image/*"
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-3 py-2 text-sm text-watt-text-sec file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                </div>

                {{-- Favicon Upload --}}
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Favicon (ICO/PNG)</label>
                    @if($setting->favicon && file_exists(public_path('img/' . $setting->favicon)))
                        <div class="mb-2 flex items-center gap-3 bg-watt-bg border border-watt-border p-3 rounded-xl">
                            <img src="{{ asset('img/' . $setting->favicon) }}" alt="Favicon" class="h-8 w-8 object-contain">
                            <span class="text-[10px] text-watt-text-sec font-mono">{{ $setting->favicon }}</span>
                        </div>
                    @endif
                    <input type="file" name="favicon" accept="image/*,.ico"
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-3 py-2 text-sm text-watt-text-sec file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-watt-cyan file:text-watt-bg hover:file:opacity-90 cursor-pointer">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Alamat Toko</label>
                        <textarea name="address" rows="2"
                            class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors resize-none">{{ old('address', $setting->address) }}</textarea>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Jam Operasional</label>
                        <input type="text" name="operating_hours" value="{{ old('operating_hours', $setting->operating_hours) }}" placeholder="09:00 - 22:00 WIB"
                            class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Teks Footer</label>
                    <textarea name="footer" rows="2"
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors resize-none">{{ old('footer', $setting->footer) }}</textarea>
                </div>
            </div>

            {{-- SEO Meta --}}
            <div class="bg-watt-surface border border-watt-border rounded-[16px] p-6 space-y-6">
                <h3 class="text-sm font-bold text-white flex items-center gap-2 border-b border-watt-border pb-4">
                    <i data-lucide="search" class="w-4 h-4 text-watt-cyan"></i>
                    SEO Meta
                </h3>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Meta Description</label>
                    <textarea name="meta_description" rows="3" placeholder="Deskripsi singkat untuk hasil pencarian Google..."
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors resize-none">{{ old('meta_description', $setting->meta_description) }}</textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $setting->meta_keywords) }}" placeholder="topup game, diamond mlbb, uc pubg, ..."
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
                    <p class="text-[10px] text-watt-text-sec">Pisahkan kata kunci dengan koma.</p>
                </div>
            </div>
        </div>

        {{-- RIGHT: Kontak & Konten --}}
        <div class="space-y-6">

            {{-- Kontak --}}
            <div class="bg-watt-surface border border-watt-border rounded-[16px] p-6 space-y-5">
                <h3 class="text-sm font-bold text-white flex items-center gap-2 border-b border-watt-border pb-4">
                    <i data-lucide="phone" class="w-4 h-4 text-watt-cyan"></i>
                    Kontak & Sosial Media
                </h3>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Nomor WhatsApp Admin <span class="text-watt-red">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-watt-text-sec text-xs font-mono">+</span>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $setting->whatsapp) }}" required placeholder="628123456789"
                            class="w-full pl-6 bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors font-mono">
                    </div>
                    <p class="text-[10px] text-watt-text-sec">Format internasional tanpa +. Contoh: 628123456789</p>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Saluran WA (Testimoni)</label>
                    <input type="url" name="whatsapp_channel" value="{{ old('whatsapp_channel', $setting->whatsapp_channel) }}" placeholder="https://whatsapp.com/channel/..."
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Instagram</label>
                    <input type="url" name="instagram" value="{{ old('instagram', $setting->instagram) }}" placeholder="https://instagram.com/..."
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Facebook</label>
                    <input type="url" name="facebook" value="{{ old('facebook', $setting->facebook) }}" placeholder="https://facebook.com/..."
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Discord</label>
                    <input type="url" name="discord" value="{{ old('discord', $setting->discord) }}" placeholder="https://discord.gg/..."
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
                </div>
            </div>

            {{-- Cara Order --}}
            <div class="bg-watt-surface border border-watt-border rounded-[16px] p-6 space-y-5">
                <h3 class="text-sm font-bold text-white flex items-center gap-2 border-b border-watt-border pb-4">
                    <i data-lucide="youtube" class="w-4 h-4 text-watt-red"></i>
                    Konten Cara Order
                </h3>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Link Video YouTube</label>
                    <input type="url" name="youtube_tutorial" value="{{ old('youtube_tutorial', $setting->youtube_tutorial) }}" placeholder="https://youtube.com/watch?v=..."
                        class="w-full bg-watt-bg border border-watt-border rounded-xl px-4 py-3 text-sm text-white placeholder-watt-text-sec focus:outline-none focus:border-watt-cyan transition-colors">
                    <p class="text-[10px] text-watt-text-sec">Video akan di-embed di halaman Cara Order.</p>
                </div>
            </div>

            {{-- Save Button --}}
            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-watt-cyan hover:opacity-90 text-watt-bg font-bold py-4 px-6 rounded-2xl transition-all shadow-lg cursor-pointer text-sm">
                <i data-lucide="save" class="w-5 h-5"></i>
                Simpan Semua Pengaturan
            </button>
        </div>

    </div>
</form>
@endsection
