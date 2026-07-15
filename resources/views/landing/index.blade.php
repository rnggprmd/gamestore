@extends('landing.layout')

@section('title', $setting->store_name ?? 'Gamestore Indonesia')

@section('content')
<!-- Hero Banner Carousel -->
<div class="relative overflow-hidden bg-[#05070f] border-b border-slate-900">
    <div x-data="{ activeSlide: 0, slidesCount: {{ count($banners) }} }" 
         x-init="setInterval(() => activeSlide = (activeSlide + 1) % slidesCount, 5000)" 
         class="relative h-[280px] sm:h-[450px] max-w-7xl mx-auto">
        
        <!-- Slides -->
        @foreach($banners as $index => $banner)
            <div x-show="activeSlide === {{ $index }}" 
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 translate-x-4"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-500"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 -translate-x-4"
                 class="absolute inset-0 flex items-center z-10">
                
                <!-- Background Image or Fallback Gradient -->
                <div class="absolute inset-0 bg-cover bg-center" 
                     style="background-image: @if($banner->image && file_exists(public_path('img/' . $banner->image))) url('{{ asset('img/' . $banner->image) }}') @else linear-gradient(to right, #05070f, #1e1b4b) @endif ;"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/80 to-transparent"></div>

                <div class="relative max-w-xl space-y-4 px-6 sm:px-12 lg:px-20 z-20">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-violet-600/10 border border-violet-500/20 text-violet-400 text-xs font-semibold tracking-wide">
                        <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                        PROMO TERBARU
                    </span>
                    <h1 class="text-3xl sm:text-5xl font-black text-white leading-tight tracking-tight">
                        {{ $banner->title }}
                    </h1>
                    <p class="text-slate-400 text-sm sm:text-base leading-relaxed">
                        {{ $banner->subtitle }}
                    </p>
                    <div class="pt-2">
                        <a href="{{ $banner->button_link ?? '#games' }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-500 hover:to-indigo-500 text-white font-bold text-sm px-6 py-3 rounded-xl transition-all duration-300 shadow-lg shadow-violet-500/20 glow-hover">
                            {{ $banner->button_text ?? 'Beli Sekarang' }}
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Slider Dots -->
        @if(count($banners) > 1)
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex gap-2">
                @foreach($banners as $index => $banner)
                    <button @click="activeSlide = {{ $index }}" 
                            :class="activeSlide === {{ $index }} ? 'w-8 bg-violet-500' : 'w-2.5 bg-slate-700'" 
                            class="h-2.5 rounded-full transition-all duration-300 cursor-pointer"></button>
                @endforeach
            </div>
        @endif

        <!-- Banner Abstract Background Elements -->
        <div class="absolute top-0 right-0 h-full w-1/2 bg-gradient-to-l from-violet-600/10 to-transparent pointer-events-none blur-3xl"></div>
    </div>
</div>

<!-- Promo & Penawaran Terbaru (Features Highlights) -->
<section class="py-12 bg-[#020617] border-b border-slate-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Promo Card 1 -->
            <div class="bg-gradient-to-r from-violet-950/20 to-indigo-950/20 border border-slate-800/80 rounded-2xl p-6 flex gap-4 items-start shadow-xl">
                <div class="w-12 h-12 rounded-xl bg-violet-600/10 border border-violet-500/20 flex items-center justify-center text-violet-400 flex-shrink-0">
                    <i data-lucide="zap" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="font-bold text-white mb-1">Proses Super Cepat</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">Top up game favorit Anda diproses secara instan hanya dalam hitungan detik setelah pembayaran dikonfirmasi.</p>
                </div>
            </div>
            <!-- Promo Card 2 -->
            <div class="bg-gradient-to-r from-violet-950/20 to-indigo-950/20 border border-slate-800/80 rounded-2xl p-6 flex gap-4 items-start shadow-xl">
                <div class="w-12 h-12 rounded-xl bg-violet-600/10 border border-violet-500/20 flex items-center justify-center text-violet-400 flex-shrink-0">
                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="font-bold text-white mb-1">100% Aman & Legal</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">Kami menjamin seluruh produk yang dijual aman, resmi, dan legal 100% tanpa risiko banned akun.</p>
                </div>
            </div>
            <!-- Promo Card 3 -->
            <div class="bg-gradient-to-r from-violet-950/20 to-indigo-950/20 border border-slate-800/80 rounded-2xl p-6 flex gap-4 items-start shadow-xl">
                <div class="w-12 h-12 rounded-xl bg-violet-600/10 border border-violet-500/20 flex items-center justify-center text-violet-400 flex-shrink-0">
                    <i data-lucide="badge-percent" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="font-bold text-white mb-1">Harga Termurah</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">Dapatkan penawaran harga terbaik dengan diskon spesial setiap harinya khusus untuk para gamers.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Games Grid -->
<section id="games" class="py-20 bg-[#030712] relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-xl mx-auto mb-16 space-y-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-violet-600/10 border border-violet-500/20 text-violet-400 text-xs font-semibold tracking-wide uppercase">
                Product Catalog
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">Daftar Game Populer</h2>
            <p class="text-slate-400 text-sm leading-relaxed">Pilih game favorit Anda untuk melihat daftar produk top up instan terlengkap dan termurah yang tersedia.</p>
        </div>

        <!-- Games Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($games as $game)
                <a href="{{ route('game.show', $game->slug) }}" class="group relative bg-slate-900/40 hover:bg-slate-900/80 border border-slate-800/80 rounded-2xl p-4 flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-1.5 hover:border-violet-500/40 glow-hover shadow-xl">
                    <!-- Thumbnail Container -->
                    <div class="w-full aspect-square rounded-xl bg-slate-800 overflow-hidden relative mb-4">
                        @if($game->thumbnail && file_exists(public_path('img/' . $game->thumbnail)))
                            <img src="{{ asset('img/' . $game->thumbnail) }}" alt="{{ $game->name }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-violet-800 to-indigo-900 flex flex-col items-center justify-center text-slate-300 font-bold group-hover:scale-105 transition-transform duration-500">
                                <i data-lucide="gamepad-2" class="w-10 h-10 text-white/40 mb-2"></i>
                            </div>
                        @endif
                        
                        <!-- Glowing Badge -->
                        <div class="absolute top-2 right-2 px-2 py-0.5 rounded-md bg-violet-600 text-white text-[9px] font-extrabold tracking-wider uppercase opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            POPULER
                        </div>
                    </div>
                    
                    <h3 class="font-bold text-sm text-slate-200 group-hover:text-white line-clamp-1 transition-colors">{{ $game->name }}</h3>
                    <p class="text-[10px] text-slate-500 mt-1 leading-normal line-clamp-2">{{ $game->description }}</p>
                    
                    <div class="mt-4 w-full bg-slate-950/80 border border-slate-800/60 rounded-xl py-1.5 text-[10px] font-bold text-violet-400 tracking-wider group-hover:bg-violet-600 group-hover:text-white group-hover:border-violet-600 transition-all duration-300">
                        TOP UP INSTAN
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Mengapa Memilih Store Kami -->
<section id="features" class="py-20 bg-[#020617] border-y border-slate-900/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-6">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-violet-600/10 border border-violet-500/20 text-violet-400 text-xs font-semibold tracking-wide uppercase">
                    OUR ADVANTAGES
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">Mengapa Memilih Store Kami?</h2>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Kami hadir sebagai platform top up game instan dengan memberikan keunggulan performa, kecepatan, dan kenyamanan terbaik bagi para gamers di Indonesia.
                </p>

                <!-- Benefit points list -->
                <div class="space-y-4 pt-4">
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-violet-600/10 border border-violet-500/20 flex items-center justify-center text-violet-400 flex-shrink-0">
                            <i data-lucide="clock" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-sm">Layanan 24 Jam Non-Stop</h4>
                            <p class="text-xs text-slate-400 mt-1">Sistem kami berjalan otomatis 24 jam sehari, 7 hari seminggu. Transaksi kapan saja sesuka Anda.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-violet-600/10 border border-violet-500/20 flex items-center justify-center text-violet-400 flex-shrink-0">
                            <i data-lucide="credit-card" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-sm">Metode Pembayaran WhatsApp</h4>
                            <p class="text-xs text-slate-400 mt-1">Checkout otomatis yang langsung terhubung ke chat WhatsApp Admin. Pembayaran praktis dan konfirmasi instan.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-violet-600/10 border border-violet-500/20 flex items-center justify-center text-violet-400 flex-shrink-0">
                            <i data-lucide="smile" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-sm">Customer Service Responsif</h4>
                            <p class="text-xs text-slate-400 mt-1">Butuh bantuan? Admin kami siap melayani seluruh pertanyaan dan bantuan transaksi Anda.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphic Panel (Stats / Mock) -->
            <div class="relative bg-slate-900/40 border border-slate-800/80 rounded-3xl p-8 overflow-hidden shadow-2xl">
                <div class="grid grid-cols-2 gap-6 relative z-10">
                    <div class="bg-[#05070f] border border-slate-800/60 p-6 rounded-2xl text-center">
                        <span class="text-3xl font-black text-violet-400 block mb-1">99.9%</span>
                        <span class="text-xs font-bold text-slate-400">Transaksi Sukses</span>
                    </div>
                    <div class="bg-[#05070f] border border-slate-800/60 p-6 rounded-2xl text-center">
                        <span class="text-3xl font-black text-violet-400 block mb-1">10k+</span>
                        <span class="text-xs font-bold text-slate-400">Pelanggan Aktif</span>
                    </div>
                    <div class="bg-[#05070f] border border-slate-800/60 p-6 rounded-2xl text-center">
                        <span class="text-3xl font-black text-violet-400 block mb-1">30+</span>
                        <span class="text-xs font-bold text-slate-400">Game Populer</span>
                    </div>
                    <div class="bg-[#05070f] border border-slate-800/60 p-6 rounded-2xl text-center">
                        <span class="text-3xl font-black text-violet-400 block mb-1">&lt; 1 Menit</span>
                        <span class="text-xs font-bold text-slate-400">Rata-rata Proses</span>
                    </div>
                </div>
                <div class="absolute inset-0 bg-gradient-to-tr from-violet-600/5 to-transparent pointer-events-none"></div>
            </div>
        </div>
    </div>
</section>

<!-- Cara Order (Tutorial steps & YouTube Embed) -->
<section id="cara-order" class="py-20 bg-[#030712]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-xl mx-auto mb-16 space-y-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-violet-600/10 border border-violet-500/20 text-violet-400 text-xs font-semibold tracking-wide uppercase">
                TUTORIAL
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">Cara Melakukan Order</h2>
            <p class="text-slate-400 text-sm leading-relaxed">Ikuti langkah-langkah mudah di bawah ini untuk melakukan top up game favorit Anda.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Step List -->
            <div class="space-y-6">
                <!-- Step 1 -->
                <div class="flex gap-4 relative">
                    <div class="w-8 h-8 rounded-full bg-violet-600 flex items-center justify-center text-white font-extrabold text-xs flex-shrink-0 shadow-lg shadow-violet-500/20">
                        1
                    </div>
                    <div>
                        <h4 class="font-bold text-white text-sm">Pilih Game</h4>
                        <p class="text-xs text-slate-400 mt-1">Pilih game populer dari daftar yang kami sediakan.</p>
                    </div>
                </div>
                <!-- Step 2 -->
                <div class="flex gap-4 relative">
                    <div class="w-8 h-8 rounded-full bg-violet-600 flex items-center justify-center text-white font-extrabold text-xs flex-shrink-0 shadow-lg shadow-violet-500/20">
                        2
                    </div>
                    <div>
                        <h4 class="font-bold text-white text-sm">Pilih Produk & Masukkan Data Akun</h4>
                        <p class="text-xs text-slate-400 mt-1">Pilih paket nominal top up game, isi data akun Anda (Username, UID, Server).</p>
                    </div>
                </div>
                <!-- Step 3 -->
                <div class="flex gap-4 relative">
                    <div class="w-8 h-8 rounded-full bg-violet-600 flex items-center justify-center text-white font-extrabold text-xs flex-shrink-0 shadow-lg shadow-violet-500/20">
                        3
                    </div>
                    <div>
                        <h4 class="font-bold text-white text-sm">Tambahkan ke Keranjang & Checkout</h4>
                        <p class="text-xs text-slate-400 mt-1">Masukkan item ke Keranjang Belanja Anda, periksa kembali data Anda, lalu klik Checkout via WhatsApp.</p>
                    </div>
                </div>
                <!-- Step 4 -->
                <div class="flex gap-4 relative">
                    <div class="w-8 h-8 rounded-full bg-violet-600 flex items-center justify-center text-white font-extrabold text-xs flex-shrink-0 shadow-lg shadow-violet-500/20">
                        4
                    </div>
                    <div>
                        <h4 class="font-bold text-white text-sm">Konfirmasi Pembayaran via WhatsApp</h4>
                        <p class="text-xs text-slate-400 mt-1">Kirim chat format pesanan ke WhatsApp Admin, lakukan transfer pembayaran, dan pesanan segera diproses!</p>
                    </div>
                </div>
            </div>

            <!-- YouTube Video Embed -->
            @php
                $youtube_id = '';
                if (!empty($setting->youtube_tutorial)) {
                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $setting->youtube_tutorial, $match)) {
                        $youtube_id = $match[1];
                    }
                }
            @endphp

            <div class="space-y-4">
                @if(!empty($youtube_id))
                    <div class="relative w-full aspect-video rounded-2xl overflow-hidden border border-slate-800 bg-slate-950 shadow-2xl">
                        <iframe class="absolute inset-0 w-full h-full"
                                src="https://www.youtube.com/embed/{{ $youtube_id }}"
                                title="Video Tutorial Cara Order"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                        </iframe>
                    </div>
                    @if($setting->youtube_tutorial)
                        <div class="text-center pt-2">
                            <a href="{{ $setting->youtube_tutorial }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-bold text-red-400 hover:text-red-300 transition-colors uppercase tracking-wider">
                                <i data-lucide="play" class="w-4 h-4 fill-red-400"></i>
                                Tonton di YouTube
                            </a>
                        </div>
                    @endif
                @else
                    <!-- Video Placeholder -->
                    <div class="w-full aspect-video rounded-2xl border border-dashed border-slate-800/80 bg-slate-950/40 flex flex-col items-center justify-center text-center p-6">
                        <div class="w-12 h-12 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-500 mb-4">
                            <i data-lucide="video" class="w-6 h-6"></i>
                        </div>
                        <h4 class="font-bold text-slate-300 text-sm">Video tutorial belum diset oleh Admin.</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Testimoni Pelanggan -->
<section id="testimonials" class="py-20 bg-[#020617] border-t border-slate-900/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-xl mx-auto mb-16 space-y-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-violet-600/10 border border-violet-500/20 text-violet-400 text-xs font-semibold tracking-wide uppercase">
                TESTIMONIALS
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">Ulasan Pelanggan</h2>
            <p class="text-slate-400 text-sm leading-relaxed">Apa kata mereka yang telah melakukan transaksi di platform top up kami?</p>
        </div>

        <!-- Testimonial Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            @foreach($testimonials as $testimonial)
                <div class="bg-slate-900/40 border border-slate-800/80 rounded-2xl p-6 relative overflow-hidden shadow-xl flex flex-col justify-between">
                    <div>
                        <!-- Rating Stars -->
                        <div class="flex items-center gap-1 text-amber-400 mb-4">
                            @for($i = 0; $i < $testimonial->rating; $i++)
                                <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                            @endfor
                        </div>
                        <!-- Message -->
                        <p class="text-slate-300 text-xs leading-relaxed italic mb-6">
                            "{{ $testimonial->message }}"
                        </p>
                    </div>

                    <!-- Client Info -->
                    <div class="flex items-center gap-3 border-t border-slate-800/40 pt-4">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-violet-600 to-indigo-600 flex items-center justify-center text-white font-extrabold text-xs">
                            {{ substr($testimonial->customer_name, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-xs">{{ $testimonial->customer_name }}</h4>
                            <span class="text-[9px] text-slate-500">Verified Buyer</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- WhatsApp Channel Action Link -->
        @if($setting->whatsapp_channel)
            <div class="text-center pt-4">
                <a href="{{ $setting->whatsapp_channel }}" target="_blank" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm px-8 py-3.5 rounded-2xl transition-all shadow-lg shadow-emerald-600/10 cursor-pointer">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    Lihat Testimoni Customer Lainnya
                </a>
            </div>
        @endif
    </div>
</section>
@endsection
