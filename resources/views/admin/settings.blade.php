@extends('admin.layout')

@section('page_title', 'Pengaturan Website')

@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- LEFT: Identitas & Branding --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Identitas Toko --}}
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
                <h3 class="text-sm font-bold text-slate-800 dark:text-white flex items-center gap-2 border-b border-slate-100 dark:border-slate-800 pb-4">
                    <i data-lucide="store" class="w-4 h-4 text-violet-500"></i>
                    Identitas Toko
                </h3>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Toko</label>
                    <input type="text" name="store_name" value="{{ old('store_name', $setting->store_name) }}" required class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
                </div>

                {{-- Logo Upload --}}
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Logo Toko</label>
                    @if($setting->logo && file_exists(public_path('img/' . $setting->logo)))
                        <div class="mb-2 flex items-center gap-3 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 p-3 rounded-2xl">
                            <img src="{{ asset('img/' . $setting->logo) }}" alt="Logo" class="h-10 w-auto object-contain">
                            <span class="text-[10px] text-slate-400 font-mono">{{ $setting->logo }}</span>
                        </div>
                    @endif
                    <input type="file" name="logo" accept="image/*" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-sm text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-violet-600 file:text-white hover:file:bg-violet-500">
                </div>

                {{-- Favicon Upload --}}
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Favicon (ICO/PNG)</label>
                    @if($setting->favicon && file_exists(public_path('img/' . $setting->favicon)))
                        <div class="mb-2 flex items-center gap-3 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 p-3 rounded-2xl">
                            <img src="{{ asset('img/' . $setting->favicon) }}" alt="Favicon" class="h-8 w-8 object-contain">
                            <span class="text-[10px] text-slate-400 font-mono">{{ $setting->favicon }}</span>
                        </div>
                    @endif
                    <input type="file" name="favicon" accept="image/*,.ico" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-sm text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-violet-600 file:text-white hover:file:bg-violet-500">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Alamat Toko</label>
                        <textarea name="address" rows="2" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">{{ old('address', $setting->address) }}</textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Jam Operasional</label>
                        <input type="text" name="operating_hours" value="{{ old('operating_hours', $setting->operating_hours) }}" placeholder="09:00 - 22:00 WIB" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Teks Footer</label>
                    <textarea name="footer" rows="2" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">{{ old('footer', $setting->footer) }}</textarea>
                </div>
            </div>

            {{-- SEO Meta --}}
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
                <h3 class="text-sm font-bold text-slate-800 dark:text-white flex items-center gap-2 border-b border-slate-100 dark:border-slate-800 pb-4">
                    <i data-lucide="search" class="w-4 h-4 text-teal-500"></i>
                    SEO Meta
                </h3>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Meta Description</label>
                    <textarea name="meta_description" rows="3" placeholder="Deskripsi singkat yang tampil di hasil pencarian Google..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">{{ old('meta_description', $setting->meta_description) }}</textarea>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $setting->meta_keywords) }}" placeholder="topup game, diamond mlbb, uc pubg, ..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
                    <p class="text-[10px] text-slate-400">Pisahkan kata kunci dengan koma.</p>
                </div>
            </div>
        </div>

        {{-- RIGHT: Kontak & Konten --}}
        <div class="space-y-6">

            {{-- Kontak --}}
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-sm space-y-5">
                <h3 class="text-sm font-bold text-slate-800 dark:text-white flex items-center gap-2 border-b border-slate-100 dark:border-slate-800 pb-4">
                    <i data-lucide="phone" class="w-4 h-4 text-emerald-500"></i>
                    Kontak & Sosial Media
                </h3>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Nomor WhatsApp Admin</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-slate-400 text-xs font-mono">+</span>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $setting->whatsapp) }}" required placeholder="628123456789" class="w-full pl-6 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
                    </div>
                    <p class="text-[10px] text-slate-400">Format internasional tanpa tanda +. Contoh: 628123456789</p>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Link Saluran WA (Testimoni)</label>
                    <input type="url" name="whatsapp_channel" value="{{ old('whatsapp_channel', $setting->whatsapp_channel) }}" placeholder="https://whatsapp.com/channel/..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Instagram</label>
                    <input type="url" name="instagram" value="{{ old('instagram', $setting->instagram) }}" placeholder="https://instagram.com/..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Facebook</label>
                    <input type="url" name="facebook" value="{{ old('facebook', $setting->facebook) }}" placeholder="https://facebook.com/..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Discord</label>
                    <input type="url" name="discord" value="{{ old('discord', $setting->discord) }}" placeholder="https://discord.gg/..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
                </div>
            </div>

            {{-- Cara Order & Testimoni --}}
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-sm space-y-5">
                <h3 class="text-sm font-bold text-slate-800 dark:text-white flex items-center gap-2 border-b border-slate-100 dark:border-slate-800 pb-4">
                    <i data-lucide="youtube" class="w-4 h-4 text-red-500"></i>
                    Konten Cara Order
                </h3>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Link Video YouTube</label>
                    <input type="url" name="youtube_tutorial" value="{{ old('youtube_tutorial', $setting->youtube_tutorial) }}" placeholder="https://youtube.com/watch?v=..." class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-800 dark:text-white focus:outline-none focus:border-violet-500">
                    <p class="text-[10px] text-slate-400">Video akan di-embed otomatis di halaman Cara Order.</p>
                </div>
            </div>

            {{-- Save Button --}}
            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-violet-600 hover:bg-violet-500 text-white font-bold py-4 px-6 rounded-2xl transition-all shadow-lg shadow-violet-500/20 cursor-pointer text-sm">
                <i data-lucide="save" class="w-5 h-5"></i>
                Simpan Semua Pengaturan
            </button>
        </div>

    </div>
</form>
@endsection
