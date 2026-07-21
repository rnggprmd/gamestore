@extends('landing.layout')

@section('title', $setting->store_name ?? 'Gamestore Indonesia')

@section('content')

{{-- =============================================
     BACKGROUND PATTERN STYLES (all sections)
     ============================================= --}}
<style>
/* === DOT GRID — Hero === */
.pattern-dots {
    background-image: radial-gradient(circle, rgba(0,174,239,0.18) 1px, transparent 1px);
    background-size: 28px 28px;
}
/* === DIAGONAL LINES — Games === */
.pattern-diag {
    background-image: repeating-linear-gradient(
        -45deg,
        rgba(0,174,239,0.06) 0px,
        rgba(0,174,239,0.06) 1px,
        transparent 1px,
        transparent 18px
    );
}
/* === HEXAGON / CROSS GRID — Features === */
.pattern-hex {
    background-image:
        linear-gradient(rgba(0,174,239,0.07) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,174,239,0.07) 1px, transparent 1px),
        linear-gradient(rgba(0,174,239,0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,174,239,0.03) 1px, transparent 1px);
    background-size: 50px 50px, 50px 50px, 10px 10px, 10px 10px;
}
/* === CIRCUIT BOARD — How To Order === */
.pattern-circuit {
    background-image:
        linear-gradient(rgba(0,174,239,0.08) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,174,239,0.08) 1px, transparent 1px);
    background-size: 40px 40px;
    background-position: -1px -1px;
}
/* === NOISE / PIXEL GRID — Testimonials === */
.pattern-noise {
    background-image: radial-gradient(ellipse at center, rgba(0,174,239,0.05) 0%, transparent 70%),
        repeating-conic-gradient(rgba(255,255,255,0.02) 0% 25%, transparent 0% 50%);
    background-size: 100% 100%, 8px 8px;
}
</style>

<!-- Hero Section -->
<section class="max-w-7xl mx-auto px-6 pt-0 pb-12 lg:pt-0 lg:pb-16 relative flex flex-col gap-6 sm:gap-12 lg:gap-16 overflow-hidden">
    {{-- DOT GRID pattern overlay --}}
    <div class="pattern-dots absolute inset-0 pointer-events-none opacity-60" style="mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 30%, transparent 100%)"></div>
    {{-- Ambient corner glows --}}
    <div class="absolute top-0 -left-20 w-72 h-72 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 -right-20 w-96 h-96 bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>
    <!-- Main Hero content (Left: Text, Right: Character) -->
    <div class="flex flex-col-reverse lg:flex-row items-center gap-10 lg:gap-16 relative">
        <!-- Left: Content -->
        <div class="flex-1 text-center lg:text-left z-20 fade-in-left -mt-12 lg:mt-0 relative">
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-heading font-black leading-tight mb-5 relative z-10">
                Welcome To <br>
                <span class="text-primary hero-glow">{{ strtoupper($setting->store_name ?? 'GAMESTORE') }}</span>
            </h1>
            <p class="text-base sm:text-lg text-gray-300 mb-8 max-w-lg mx-auto lg:mx-0 relative z-10">
                Top Up Game Premium dengan Harga Terbaik
            </p>
        </div>
        
        <!-- Right: Illustration -->
        <div class="flex-1 relative z-0 flex justify-center lg:justify-end w-full fade-in-right">
            <div class="character-glow relative">
                <!-- Giant watermark logo way in the back -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-0 pointer-events-none select-none">
                    <img src="{{ asset('img/logo gamestore.png') }}" 
                         alt="Gamestore Watermark Background" 
                         class="w-[420px] h-[420px] sm:w-[500px] sm:h-[500px] lg:w-[700px] lg:h-[700px] xl:w-[800px] xl:h-[800px] rounded-full opacity-25 animate-spin-slow drop-shadow-[0_0_60px_rgba(0,174,239,0.4)]">
                </div>

                <!-- Floating logo & robux icons behind/around the character -->
                <img src="{{ asset('img/logo gamestore.png') }}" 
                     alt="Gamestore Logo Bubble"
                     class="absolute top-8 left-12 w-14 h-14 rounded-full border border-primary/20 shadow-[0_0_15px_rgba(0,174,239,0.2)] animate-float-slow opacity-60 z-0 select-none">
                <img src="{{ asset('img/robux.png') }}" 
                     alt="Robux Bubble"
                     class="absolute bottom-16 right-4 w-18 h-18 rounded-full border border-primary/30 shadow-[0_0_20px_rgba(0,174,239,0.35)] animate-float-fast opacity-60 z-0 select-none">
                <img src="{{ asset('img/logo gamestore.png') }}" 
                     alt="Gamestore Logo Bubble"
                     class="absolute top-1/2 -left-6 w-11 h-11 rounded-full border border-primary/15 shadow-[0_0_10px_rgba(0,174,239,0.15)] animate-float-medium opacity-40 z-0 select-none">
                <img src="{{ asset('img/robux.png') }}" 
                     alt="Robux Bubble"
                     class="absolute top-2 right-20 w-12 h-12 rounded-full border border-primary/20 shadow-[0_0_12px_rgba(0,174,239,0.2)] animate-float-medium opacity-50 z-0 select-none">
                <img src="{{ asset('img/logo gamestore.png') }}" 
                     alt="Gamestore Logo Bubble"
                     class="absolute bottom-6 left-16 w-15 h-15 rounded-full border border-primary/25 shadow-[0_0_18px_rgba(0,174,239,0.25)] animate-float-slow opacity-45 z-0 select-none">
                <img src="{{ asset('img/robux.png') }}" 
                     alt="Robux Bubble"
                     class="absolute top-1/3 -right-6 w-11 h-11 rounded-full border border-primary/20 shadow-[0_0_10px_rgba(0,174,239,0.2)] animate-float-fast opacity-55 z-0 select-none">

                <img src="{{ asset('img/karakter.png') }}" 
                     alt="Gaming Character" 
                     class="character-float w-full max-w-[550px] lg:max-w-[780px] xl:max-w-[900px] h-auto object-contain relative z-10">
            </div>
        </div>
    </div>

    <!-- Features Section (Merged under the Trusted by text & Character image) -->
    <div class="grid grid-cols-4 gap-2 sm:gap-4 lg:gap-6 relative z-20 md:-mt-20 lg:-mt-36 xl:-mt-48 stagger-animation">
        <!-- Feature 1 -->
        <div class="bg-[#141A28] border border-white/10 rounded-xl sm:rounded-2xl p-2.5 sm:p-5 flex flex-col sm:flex-row items-center sm:items-center text-center sm:text-left gap-2 sm:gap-4 transition-all duration-300 hover:border-primary/45 hover:-translate-y-1 shadow-lg group cursor-pointer">
            <div class="w-9 h-9 sm:w-12 sm:h-12 bg-primary/10 rounded-lg sm:rounded-xl flex items-center justify-center text-primary text-base sm:text-xl shrink-0 border border-primary/20 shadow-[0_0_15px_rgba(0,174,239,0.15)] group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                <i class="fas fa-users"></i>
            </div>
            <div class="w-full">
                <h3 class="text-[11px] sm:text-sm font-bold text-white mb-0.5 leading-tight">100% Terpercaya</h3>
                <p class="text-[9px] sm:text-[11px] text-gray-400 leading-tight hidden sm:block">Terpercaya dan aman untuk semua transaksi game.</p>
            </div>
        </div>
        
        <!-- Feature 2 -->
        <div class="bg-[#141A28] border border-white/10 rounded-xl sm:rounded-2xl p-2.5 sm:p-5 flex flex-col sm:flex-row items-center sm:items-center text-center sm:text-left gap-2 sm:gap-4 transition-all duration-300 hover:border-primary/45 hover:-translate-y-1 shadow-lg group cursor-pointer">
            <div class="w-9 h-9 sm:w-12 sm:h-12 bg-primary/10 rounded-lg sm:rounded-xl flex items-center justify-center text-primary text-base sm:text-xl shrink-0 border border-primary/20 shadow-[0_0_15px_rgba(0,174,239,0.15)] group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                <i class="fas fa-bolt"></i>
            </div>
            <div class="w-full">
                <h3 class="text-[11px] sm:text-sm font-bold text-white mb-0.5 leading-tight">Proses Instan</h3>
                <p class="text-[9px] sm:text-[11px] text-gray-400 leading-tight hidden sm:block">Pengiriman instan otomatis hitungan detik.</p>
            </div>
        </div>
        
        <!-- Feature 3 -->
        <div class="bg-[#141A28] border border-white/10 rounded-xl sm:rounded-2xl p-2.5 sm:p-5 flex flex-col sm:flex-row items-center sm:items-center text-center sm:text-left gap-2 sm:gap-4 transition-all duration-300 hover:border-primary/45 hover:-translate-y-1 shadow-lg group cursor-pointer">
            <div class="w-9 h-9 sm:w-12 sm:h-12 bg-primary/10 rounded-lg sm:rounded-xl flex items-center justify-center text-primary text-base sm:text-xl shrink-0 border border-primary/20 shadow-[0_0_15px_rgba(0,174,239,0.15)] group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                <i class="fas fa-tag"></i>
            </div>
            <div class="w-full">
                <h3 class="text-[11px] sm:text-sm font-bold text-white mb-0.5 leading-tight">Harga Terbaik</h3>
                <p class="text-[9px] sm:text-[11px] text-gray-400 leading-tight hidden sm:block">Harga paling kompetitif dan banyak promo.</p>
            </div>
        </div>
        
        <!-- Feature 4 -->
        <div class="bg-[#141A28] border border-white/10 rounded-xl sm:rounded-2xl p-2.5 sm:p-5 flex flex-col sm:flex-row items-center sm:items-center text-center sm:text-left gap-2 sm:gap-4 transition-all duration-300 hover:border-primary/45 hover:-translate-y-1 shadow-lg group cursor-pointer">
            <div class="w-9 h-9 sm:w-12 sm:h-12 bg-primary/10 rounded-lg sm:rounded-xl flex items-center justify-center text-primary text-base sm:text-xl shrink-0 border border-primary/20 shadow-[0_0_15px_rgba(0,174,239,0.15)] group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                <i class="fas fa-headset"></i>
            </div>
            <div class="w-full">
                <h3 class="text-[11px] sm:text-sm font-bold text-white mb-0.5 leading-tight">Layanan 24/7</h3>
                <p class="text-[9px] sm:text-[11px] text-gray-400 leading-tight hidden sm:block">Customer support siap membantu kapan saja.</p>
            </div>
        </div>
    </div>

    <!-- Operating Hours Banner / Card -->
    <div class="relative z-20 -mt-2 sm:-mt-6 lg:-mt-10 fade-in">
        <div class="bg-gradient-to-r from-[#141A28] via-[#1a2336] to-[#141A28] border border-primary/30 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-[0_0_25px_rgba(0,174,239,0.1)] hover:border-primary/50 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 bg-primary/15 rounded-xl flex items-center justify-center text-primary text-xl shrink-0 border border-primary/30 shadow-[0_0_15px_rgba(0,174,239,0.2)]">
                    <i class="far fa-clock"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white flex items-center gap-2">
                        Jam Operasional Toko
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping mr-1"></span> Online
                        </span>
                    </h3>
                    <p class="text-xs text-gray-300 mt-0.5">Layanan transaksi dan dukungan pelanggan diproses sesuai jam operasional.</p>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto shrink-0 justify-center">
                <div class="px-4 py-2 bg-primary/10 border border-primary/25 rounded-xl flex items-center gap-2 text-primary font-bold text-sm shadow-[0_0_10px_rgba(0,174,239,0.15)] w-full sm:w-auto justify-center">
                    <i class="fas fa-business-time text-xs"></i>
                    <span>{{ $setting->operating_hours ?? '09:00 - 22:00 WIB' }}</span>
                </div>
                @if($setting->whatsapp_channel)
                <a href="{{ $setting->whatsapp_channel }}" target="_blank" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 border border-emerald-500/20 rounded-xl flex items-center gap-2 text-white font-bold text-xs shadow-md hover:scale-105 active:scale-95 transition-all w-full sm:w-auto justify-center cursor-pointer">
                    <i class="fas fa-bullhorn text-xs"></i>
                    <span>Gabung Saluran WA</span>
                </a>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Section Divider -->
<div class="max-w-7xl mx-auto px-6"><div class="border-t border-white/5"></div></div>

<!-- Popular Games -->
<section id="games" class="relative py-8 lg:py-12 overflow-hidden">
    {{-- DIAGONAL LINES pattern --}}
    <div class="pattern-diag absolute inset-0 pointer-events-none"></div>
    {{-- Glow blobs at corners --}}
    <div class="absolute top-1/4 -right-10 w-64 h-64 bg-primary/8 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 -left-10 w-56 h-56 bg-blue-900/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
    <!-- Section Header -->
    <div class="mb-12 lg:mb-16 animate-on-scroll">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-heading font-black mb-4">Daftar Game Populer</h2>
        <div class="w-12 h-1 bg-primary rounded-full"></div>
    </div>
    
    <!-- Search Box -->
    <div class="mb-12 animate-on-scroll" x-data="gameSearchFilter()">
        <div class="relative">
            <input type="text" 
                   x-model="searchQuery"
                   @input="filterBySearch()"
                   placeholder="Cari game favorit Anda..." 
                   class="w-full px-6 py-4 rounded-xl bg-[#141A28] border border-white/20 text-white placeholder-gray-500 focus:outline-none focus:border-primary transition-colors text-base">
            <i class="fas fa-search absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
        </div>
    </div>
    
    <!-- Category Filter -->
    <div class="flex flex-wrap gap-4 mb-16 animate-on-scroll" x-data="gameFilter()">
        <button @click="selectedCategory = 'all'; filterGames()" 
                :class="selectedCategory === 'all' ? 'bg-primary text-white border-primary' : 'bg-transparent text-gray-300 border-white/20 hover:border-primary/50'"
                class="px-6 py-3 rounded-full border font-semibold text-sm transition-all duration-300 flex items-center gap-2 whitespace-nowrap">
            <i class="fas fa-th"></i>
            Semua Produk
        </button>
        @foreach($categories as $category)
        <button @click="selectedCategory = '{{ $category->id }}'; filterGames()"
                :class="selectedCategory === '{{ $category->id }}' ? 'bg-primary text-white border-primary' : 'bg-transparent text-gray-300 border-white/20 hover:border-primary/50'"
                class="px-6 py-3 rounded-full border font-semibold text-sm transition-all duration-300 flex items-center gap-2 whitespace-nowrap">
            <i class="fas fa-tag text-xs"></i>
            {{ $category->name }}
        </button>
        @endforeach
    </div>
    
    <!-- Carousel Container -->
    <div class="pt-8 pb-12">
        <!-- ===== MOBILE CAROUSEL (1 card per slide) ===== -->
        <div class="lg:hidden"
             x-data="gameCarouselMobile()"
             @touchstart="touchStart($event)"
             @touchend="touchEnd($event)"
             tabindex="0"
             @keydown.left="prevPage()"
             @keydown.right="nextPage()">

            <div class="overflow-hidden">
                <div class="flex transition-transform duration-500"
                     :style="{ transform: `translateX(-${currentPage * 100}%)` }">
                    @foreach($games as $game)
                    <div class="w-full flex-shrink-0 px-4">
                        <a href="{{ route('game.show', $game->slug) }}"
                           class="game-card rounded-2xl p-4 flex flex-col relative group game-item transition-all duration-300 block h-full"
                           data-categories="{{ json_encode($game->products->pluck('category_id')->unique()->toArray()) }}">
                            <!-- Glow -->
                            <div class="absolute -inset-4 pointer-events-none">
                                <div class="absolute -top-3 -right-3 w-24 h-24 bg-primary/30 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <!-- Badge -->
                            <div class="absolute top-4 left-4 z-20 bg-[#0B101E]/90 backdrop-blur-sm border border-white/10 text-primary text-[10px] font-bold px-3 py-1 rounded-lg tracking-wider uppercase">
                                Active ⚡
                            </div>
                            <!-- Image -->
                            <div class="w-full h-48 overflow-hidden rounded-xl mb-4 relative z-10">
                                @if($game->thumbnail && file_exists(public_path('img/' . $game->thumbnail)))
                                    <img src="{{ asset('img/' . $game->thumbnail) }}" alt="{{ $game->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-violet-800 to-indigo-900 flex items-center justify-center">
                                        <i class="fas fa-gamepad text-white/40 text-4xl"></i>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-bg-dark/80 via-transparent to-transparent opacity-60"></div>
                            </div>
                            <!-- Content -->
                            <div class="relative z-10 flex flex-col flex-1">
                                <h3 class="text-base font-bold group-hover:text-primary transition-colors duration-300 line-clamp-2 mb-2">{{ $game->name }}</h3>
                                <div class="flex-1 mb-4">
                                    <p class="text-xs text-gray-400 line-clamp-2 leading-relaxed">{{ $game->description ?: 'Game terpopuler dengan berbagai fitur menarik.' }}</p>
                                </div>
                                <button class="w-full btn-primary py-2.5 rounded-lg text-xs font-bold flex items-center justify-center gap-1.5 transition-all duration-300">
                                    <span>Beli Sekarang</span>
                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                </button>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Mobile Pagination Dots -->
            @if($games->count() > 1)
            <div class="flex justify-center gap-2 mt-8">
                @foreach($games as $index => $game)
                <button @click="currentPage = {{ $loop->index }}"
                        :class="currentPage === {{ $loop->index }} ? 'bg-primary w-8' : 'bg-white/30 hover:bg-white/50'"
                        class="h-2.5 rounded-full transition-all duration-300 cursor-pointer"></button>
                @endforeach
            </div>
            @endif
        </div>

        <!-- ===== DESKTOP CAROUSEL (4 cards per slide) ===== -->
        <div class="hidden lg:block"
             x-data="gameCarouselDesktop()"
             @wheel="handleWheel($event)"
             @keydown.left="prevPage()"
             @keydown.right="nextPage()"
             tabindex="0">

            <div class="overflow-hidden">
                <div class="flex transition-transform duration-500"
                     :style="{ transform: `translateX(-${currentPage * 100}%)` }">
                    @foreach($games->chunk(4) as $pageIndex => $page)
                    <div class="w-full flex-shrink-0">
                        <div class="grid grid-cols-4 gap-8 px-6 grid-rows-1">
                            @foreach($page as $game)
                            <a href="{{ route('game.show', $game->slug) }}"
                               class="game-card rounded-2xl p-4 flex flex-col relative group game-item transition-all duration-300 will-change-transform h-full"
                               data-categories="{{ json_encode($game->products->pluck('category_id')->unique()->toArray()) }}">
                                <!-- Glow -->
                                <div class="absolute -inset-6 pointer-events-none">
                                    <div class="absolute -top-3 -right-3 w-24 h-24 bg-primary/30 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                                <!-- Badge -->
                                <div class="absolute top-4 left-4 z-20 bg-[#0B101E]/90 backdrop-blur-sm border border-white/10 text-primary text-[10px] font-bold px-3 py-1 rounded-lg tracking-wider uppercase">
                                    Active ⚡
                                </div>
                                <!-- Image -->
                                <div class="w-full h-56 overflow-hidden rounded-xl mb-4 relative z-10">
                                    @if($game->thumbnail && file_exists(public_path('img/' . $game->thumbnail)))
                                        <img src="{{ asset('img/' . $game->thumbnail) }}" alt="{{ $game->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-violet-800 to-indigo-900 flex items-center justify-center">
                                            <i class="fas fa-gamepad text-white/40 text-5xl"></i>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-bg-dark/80 via-transparent to-transparent opacity-60 group-hover:opacity-40 transition-opacity duration-300"></div>
                                </div>
                                <!-- Content -->
                                <div class="relative z-10 flex flex-col flex-1">
                                    <h3 class="text-base font-bold group-hover:text-primary transition-colors duration-300 line-clamp-2 mb-3">{{ $game->name }}</h3>
                                    <div class="flex-1 mb-4">
                                        <p class="text-xs text-gray-400 line-clamp-2 leading-relaxed">{{ $game->description ?: 'Game terpopuler dengan berbagai fitur menarik yang dapat dinikmati.' }}</p>
                                    </div>
                                    <button class="w-full btn-primary py-2.5 rounded-lg text-xs font-bold flex items-center justify-center gap-1.5 shadow-[0_4px_12px_rgba(0,174,239,0.15)] group-hover:shadow-[0_4px_20px_rgba(0,174,239,0.35)] transition-all duration-300 mt-auto">
                                        <span>Beli Sekarang</span>
                                        <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-0.5 transition-transform"></i>
                                    </button>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Desktop Pagination Dots -->
            @if($games->count() > 4)
            <div class="flex justify-center gap-2 mt-10">
                @foreach($games->chunk(4) as $index => $page)
                <button @click="currentPage = {{ $loop->index }}"
                        :class="currentPage === {{ $loop->index }} ? 'bg-primary w-8' : 'bg-white/30 hover:bg-white/50'"
                        class="h-2.5 rounded-full transition-all duration-300 cursor-pointer"></button>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    </div>
</section>

<!-- Section Divider -->
<div class="max-w-7xl mx-auto px-6"><div class="border-t border-white/5"></div></div>

<!-- Why Choose Us -->
<section id="features" class="relative py-8 lg:py-12 overflow-hidden">
    {{-- GRID / HEX pattern --}}
    <div class="pattern-hex absolute inset-0 pointer-events-none"></div>
    {{-- Central radial glow --}}
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_60%_50%_at_50%_50%,rgba(0,174,239,0.06)_0%,transparent_100%)] pointer-events-none"></div>
    {{-- Side accent lines --}}
    <div class="absolute left-0 top-0 bottom-0 w-px bg-gradient-to-b from-transparent via-primary/20 to-transparent pointer-events-none"></div>
    <div class="absolute right-0 top-0 bottom-0 w-px bg-gradient-to-b from-transparent via-primary/20 to-transparent pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
    <div class="text-center mb-12 lg:mb-16 animate-on-scroll">
        <h2 class="text-3xl sm:text-4xl font-heading font-black mb-4">Mengapa Memilih Kami?</h2>
        <div class="w-20 h-1 bg-gradient-to-r from-primary to-primary-dark mx-auto rounded-full shadow-[0_0_15px_rgba(0,174,239,0.6)]"></div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 stagger-animation">
        <!-- Card 1 -->
        <div class="bg-[#141A28] border border-white/10 rounded-2xl p-6 lg:p-8 flex flex-col items-center text-center relative overflow-hidden transition-all duration-300 hover:border-primary/30 hover:-translate-y-1 shadow-lg group">
            <!-- Background number -->
            <div class="absolute bottom-2 right-4 text-white/[0.02] text-6xl font-mono font-black select-none pointer-events-none group-hover:text-primary/[0.05] transition-colors duration-300">01</div>
            
            <div class="w-16 h-16 lg:w-20 lg:h-20 bg-primary/10 rounded-2xl flex items-center justify-center text-primary text-3xl lg:text-4xl mb-6 shadow-glow border border-primary/20 group-hover:border-primary/50 transition-colors duration-300">
                <i class="fas fa-bolt"></i>
            </div>
            <h3 class="text-lg font-bold mb-3 text-white">Proses Cepat & Otomatis</h3>
            <p class="text-sm text-gray-400 leading-relaxed">Transaksi diproses secara instan dan otomatis dalam hitungan detik setelah pembayaran dikonfirmasi.</p>
        </div>
        
        <!-- Card 2 -->
        <div class="bg-[#141A28] border border-white/10 rounded-2xl p-6 lg:p-8 flex flex-col items-center text-center relative overflow-hidden transition-all duration-300 hover:border-primary/30 hover:-translate-y-1 shadow-lg group">
            <!-- Background number -->
            <div class="absolute bottom-2 right-4 text-white/[0.02] text-6xl font-mono font-black select-none pointer-events-none group-hover:text-primary/[0.05] transition-colors duration-300">02</div>
            
            <div class="w-16 h-16 lg:w-20 lg:h-20 bg-primary/10 rounded-2xl flex items-center justify-center text-primary text-3xl lg:text-4xl mb-6 shadow-glow border border-primary/20 group-hover:border-primary/50 transition-colors duration-300">
                <i class="fas fa-tag"></i>
            </div>
            <h3 class="text-lg font-bold mb-3 text-white">Harga Termurah & Bersaing</h3>
            <p class="text-sm text-gray-400 leading-relaxed">Kami menawarkan penawaran terbaik dan harga paling kompetitif untuk semua item game favoritmu.</p>
        </div>
        
        <!-- Card 3 -->
        <div class="bg-[#141A28] border border-white/10 rounded-2xl p-6 lg:p-8 flex flex-col items-center text-center relative overflow-hidden transition-all duration-300 hover:border-primary/30 hover:-translate-y-1 shadow-lg group">
            <!-- Background number -->
            <div class="absolute bottom-2 right-4 text-white/[0.02] text-6xl font-mono font-black select-none pointer-events-none group-hover:text-primary/[0.05] transition-colors duration-300">03</div>
            
            <div class="w-16 h-16 lg:w-20 lg:h-20 bg-primary/10 rounded-2xl flex items-center justify-center text-primary text-3xl lg:text-4xl mb-6 shadow-glow border border-primary/20 group-hover:border-primary/50 transition-colors duration-300">
                <i class="fas fa-shield-halved"></i>
            </div>
            <h3 class="text-lg font-bold mb-3 text-white">Keamanan Terjamin 100%</h3>
            <p class="text-sm text-gray-400 leading-relaxed">Sistem gateway pembayaran yang aman terintegrasi penuh untuk melindungi setiap transaksi belanja Anda.</p>
        </div>
        
        <!-- Card 4 -->
        <div class="bg-[#141A28] border border-white/10 rounded-2xl p-6 lg:p-8 flex flex-col items-center text-center relative overflow-hidden transition-all duration-300 hover:border-primary/30 hover:-translate-y-1 shadow-lg group">
            <!-- Background number -->
            <div class="absolute bottom-2 right-4 text-white/[0.02] text-6xl font-mono font-black select-none pointer-events-none group-hover:text-primary/[0.05] transition-colors duration-300">04</div>
            
            <div class="w-16 h-16 lg:w-20 lg:h-20 bg-primary/10 rounded-2xl flex items-center justify-center text-primary text-3xl lg:text-4xl mb-6 shadow-glow border border-primary/20 group-hover:border-primary/50 transition-colors duration-300">
                <i class="fas fa-headset"></i>
            </div>
            <h3 class="text-lg font-bold mb-3 text-white">Layanan CS 24 Jam</h3>
            <p class="text-sm text-gray-400 leading-relaxed">Tim bantuan customer support ramah kami siap mendampingi kendala Anda kapan pun dibutuhkan.</p>
        </div>
    </div>
    </div>
</section>

<!-- Section Divider -->
<div class="max-w-7xl mx-auto px-6"><div class="border-t border-white/5"></div></div>

<!-- How to Order -->
<section id="cara-order" class="relative py-8 lg:py-12 overflow-hidden">
    {{-- CIRCUIT BOARD pattern --}}
    <div class="pattern-circuit absolute inset-0 pointer-events-none"></div>
    {{-- Glow spots --}}
    <div class="absolute top-0 left-1/4 w-80 h-40 bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-80 h-40 bg-blue-800/10 rounded-full blur-3xl pointer-events-none"></div>
    {{-- Top & bottom separator lines --}}
    <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-primary/20 to-transparent pointer-events-none"></div>
    <div class="absolute bottom-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-primary/20 to-transparent pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
    <div class="text-center mb-12 lg:mb-16 animate-on-scroll">
        <h2 class="text-3xl sm:text-4xl font-heading font-black mt-3 mb-4">Cara Melakukan Order</h2>
        <div class="w-20 h-1 bg-gradient-to-r from-primary to-primary-dark mx-auto rounded-full shadow-[0_0_15px_rgba(0,174,239,0.6)]"></div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
        <!-- Left: Video Player (7 Cols) -->
        <div class="lg:col-span-7 relative group fade-in-left">
            <div class="absolute -inset-2 bg-gradient-to-r from-primary/30 to-primary-dark/20 blur-xl rounded-3xl opacity-75 group-hover:opacity-100 transition-opacity duration-500"></div>
            
            <!-- Video Mock Player Frame -->
            <div class="relative bg-bg-card rounded-2xl border border-white/10 overflow-hidden shadow-2xl">
                <!-- Top Player Control Dots -->
                <div class="flex items-center gap-1.5 px-4 py-3 bg-bg-dark/80 border-b border-white/5">
                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500/80"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500/80"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500/80"></span>
                    <span class="text-[10px] text-gray-500 font-mono ml-2">Video_Panduan.mp4</span>
                </div>
                
                <div class="aspect-video bg-black/90">
                    @php
                        $youtube_id = '';
                        if (!empty($setting->youtube_tutorial)) {
                            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $setting->youtube_tutorial, $match)) {
                                $youtube_id = $match[1];
                            }
                        }
                    @endphp
                    
                    @if(!empty($youtube_id))
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $youtube_id }}" title="Tutorial" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center p-6 text-center">
                            <div class="w-16 h-16 rounded-full bg-primary/10 border border-primary/20 flex items-center justify-center mb-3">
                                <i class="fas fa-video text-2xl text-primary"></i>
                            </div>
                            <p class="text-sm font-semibold text-gray-200">Video tutorial sedang disiapkan</p>
                            <p class="text-xs text-gray-500 mt-1 max-w-[200px] mx-auto">Kami akan segera menyematkan video panduan terbaru.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Right: Stepper Steps (5 Cols) -->
        <div class="lg:col-span-5 relative flex flex-col gap-6 pl-4 lg:pl-10 fade-in-right">
            <!-- Central connection track line -->
            <div class="absolute left-9 top-6 bottom-6 w-[2px] bg-gradient-to-b from-primary/60 via-primary-dark/30 to-white/5"></div>
            
            <!-- Step 1 -->
            <div class="relative flex gap-6 items-start group">
                <!-- Glow circle connector -->
                <div class="w-10 h-10 rounded-full bg-bg-card border-2 border-primary flex items-center justify-center text-primary text-sm font-bold z-10 shrink-0 group-hover:scale-110 group-hover:shadow-[0_0_15px_rgba(0,174,239,0.5)] transition-all duration-300">
                    01
                </div>
                <div class="bg-bg-card border border-white/10 rounded-2xl p-5 hover:border-primary/40 transition-colors duration-300 flex-grow shadow-lg">
                    <h4 class="font-bold text-white text-base mb-1.5 flex items-center gap-2">
                        <i class="fas fa-gamepad text-primary/75 text-sm"></i>
                        Pilih Game & Item
                    </h4>
                    <p class="text-sm text-gray-400 leading-relaxed">Pilih game favoritmu dari katalog, lalu pilih nominal item top-up atau paket yang kamu butuhkan.</p>
                </div>
            </div>
            
            <!-- Step 2 -->
            <div class="relative flex gap-6 items-start group">
                <!-- Glow circle connector -->
                <div class="w-10 h-10 rounded-full bg-bg-card border-2 border-primary/40 flex items-center justify-center text-primary/80 text-sm font-bold z-10 shrink-0 group-hover:scale-110 group-hover:border-primary group-hover:text-primary group-hover:shadow-[0_0_15px_rgba(0,174,239,0.5)] transition-all duration-300">
                    02
                </div>
                <div class="bg-bg-card border border-white/10 rounded-2xl p-5 hover:border-primary/40 transition-colors duration-300 flex-grow shadow-lg">
                    <h4 class="font-bold text-white text-base mb-1.5 flex items-center gap-2">
                        <i class="fas fa-user-edit text-primary/75 text-sm"></i>
                        Isi Data Akun
                    </h4>
                    <p class="text-sm text-gray-400 leading-relaxed">Masukkan User ID, Zone ID, atau Username game kamu dengan lengkap dan benar untuk menghindari kesalahan pengiriman.</p>
                </div>
            </div>
            
            <!-- Step 3 -->
            <div class="relative flex gap-6 items-start group">
                <!-- Glow circle connector -->
                <div class="w-10 h-10 rounded-full bg-bg-card border-2 border-primary/40 flex items-center justify-center text-primary/80 text-sm font-bold z-10 shrink-0 group-hover:scale-110 group-hover:border-primary group-hover:text-primary group-hover:shadow-[0_0_15px_rgba(0,174,239,0.5)] transition-all duration-300">
                    03
                </div>
                <div class="bg-bg-card border border-white/10 rounded-2xl p-5 hover:border-primary/40 transition-colors duration-300 flex-grow shadow-lg">
                    <h4 class="font-bold text-white text-base mb-1.5 flex items-center gap-2">
                        <i class="fas fa-wallet text-primary/75 text-sm"></i>
                        Pilih Metode Pembayaran
                    </h4>
                    <p class="text-sm text-gray-400 leading-relaxed">Pilih opsi pembayaran ternyaman dari e-wallet, virtual account, transfer bank, hingga retail store terdekat.</p>
                </div>
            </div>
            
            <!-- Step 4 -->
            <div class="relative flex gap-6 items-start group">
                <!-- Glow circle connector -->
                <div class="w-10 h-10 rounded-full bg-bg-card border-2 border-primary/40 flex items-center justify-center text-primary/80 text-sm font-bold z-10 shrink-0 group-hover:scale-110 group-hover:border-primary group-hover:text-primary group-hover:shadow-[0_0_15px_rgba(0,174,239,0.5)] transition-all duration-300">
                    04
                </div>
                <div class="bg-bg-card border border-white/10 rounded-2xl p-5 hover:border-primary/40 transition-colors duration-300 flex-grow shadow-lg">
                    <h4 class="font-bold text-white text-base mb-1.5 flex items-center gap-2">
                        <i class="fas fa-check-circle text-primary/75 text-sm"></i>
                        Selesaikan Pembayaran
                    </h4>
                    <p class="text-sm text-gray-400 leading-relaxed">Lakukan transfer/pembayaran. Sistem otomatis kami akan memproses & mengirim item masuk ke akun kamu hanya dalam hitungan detik.</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-14 lg:mt-16 text-center scale-in">
        <a href="#games" class="btn-primary px-10 py-4 rounded-full text-white font-bold text-lg shadow-[0_0_20px_rgba(0,174,239,0.4)] hover:scale-105 transition-transform inline-block">
            Mulai Belanja Sekarang
        </a>
    </div>
    </div>
</section>

<!-- Section Divider -->
<div class="max-w-7xl mx-auto px-6"><div class="border-t border-white/5"></div></div>

<!-- Customer Reviews -->
<section id="testimonials" class="relative py-8 lg:py-12 overflow-hidden">
    {{-- NOISE / PIXEL pattern --}}
    <div class="pattern-noise absolute inset-0 pointer-events-none"></div>
    {{-- Large radial glow from top --}}
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[700px] h-64 bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>
    {{-- Star dots decoration --}}
    <div class="absolute top-8 left-8 w-1 h-1 rounded-full bg-primary/40 pointer-events-none"></div>
    <div class="absolute top-16 left-24 w-1.5 h-1.5 rounded-full bg-primary/30 pointer-events-none"></div>
    <div class="absolute top-6 right-16 w-1 h-1 rounded-full bg-primary/40 pointer-events-none"></div>
    <div class="absolute top-20 right-8 w-2 h-2 rounded-full bg-primary/20 pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
    <div class="text-center mb-12 lg:mb-16 animate-on-scroll">
        <h2 class="text-3xl sm:text-4xl font-heading font-black mt-3 mb-4">Ulasan Pelanggan</h2>
        <div class="w-20 h-1 bg-gradient-to-r from-primary to-primary-dark mx-auto rounded-full shadow-[0_0_15px_rgba(0,174,239,0.6)]"></div>
        
        <!-- Trust badge statistics -->
        <div class="flex items-center justify-center gap-6 mt-6 text-gray-400 text-xs sm:text-sm">
            <div class="flex items-center gap-1.5">
                <i class="fas fa-check-circle text-emerald-500"></i>
                <span>100% Pembeli Terverifikasi</span>
            </div>
            <div class="w-[1px] h-4 bg-white/10"></div>
            <div class="flex items-center gap-1">
                <span class="text-yellow-400 font-bold">★ 4.9 / 5.0</span>
                <span>Nilai Kepuasan</span>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 stagger-animation">
        @foreach($testimonials->take(3) as $index => $testimonial)
        @php
            // Assign gradient classes for avatars to make it look premium
            $gradients = [
                'from-violet-600 to-indigo-600',
                'from-emerald-500 to-teal-600',
                'from-pink-500 to-rose-600',
                'from-amber-500 to-orange-600',
                'from-cyan-500 to-blue-600'
            ];
            $avatarGrad = $gradients[$index % count($gradients)];
            $initial = strtoupper(substr($testimonial->customer_name, 0, 1));
        @endphp
        
        <div class="bg-[#141A28] border border-white/10 rounded-2xl p-6 lg:p-7 relative overflow-hidden transition-all duration-300 hover:border-primary/30 hover:-translate-y-1 shadow-lg group">
            <!-- Large decorative background quote mark -->
            <div class="absolute right-4 top-2 text-white/[0.03] text-7xl font-serif select-none pointer-events-none group-hover:text-primary/[0.06] transition-colors duration-300">
                ”
            </div>
            
            <!-- Header: Avatar Initials + Customer info -->
            <div class="flex items-center gap-3.5 mb-5">
                <div class="w-11 h-11 rounded-full bg-gradient-to-tr {{ $avatarGrad }} flex items-center justify-center text-white font-bold text-sm shadow-md">
                    {{ $initial }}
                </div>
                <div>
                    <h4 class="font-bold text-white text-sm tracking-wide">{{ $testimonial->customer_name }}</h4>
                    <div class="flex text-yellow-400 text-[11px] gap-0.5 mt-0.5">
                        @for($i = 0; $i < $testimonial->rating; $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                        @for($i = $testimonial->rating; $i < 5; $i++)
                            <i class="far fa-star text-gray-600"></i>
                        @endfor
                    </div>
                </div>
            </div>
            
            <!-- Message -->
            <p class="text-gray-300 italic leading-relaxed text-sm relative z-10 mb-5">
                "{{ $testimonial->message }}"
            </p>
            
            <!-- Footer Verification Tag -->
            <div class="flex items-center gap-1.5 pt-3.5 border-t border-white/5 text-[10px] text-emerald-500 font-bold uppercase tracking-wider">
                <i class="fas fa-check-circle text-[11px]"></i>
                Verified Purchase
            </div>
        </div>
        @endforeach
    </div>
    
    @if($setting->whatsapp_channel)
    <div class="text-center mt-12 lg:mt-16 scale-in">
        <a href="{{ $setting->whatsapp_channel }}" target="_blank" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm px-8 py-3.5 rounded-2xl transition-all shadow-lg shadow-emerald-600/10 hover:scale-105">
            <i class="fab fa-whatsapp"></i>
            Lihat Testimoni Customer Lainnya
        </a>
    </div>
    @endif
    </div>
</section>
@endsection
