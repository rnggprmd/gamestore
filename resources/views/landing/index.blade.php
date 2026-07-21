@extends('landing.layout')

@section('title', $setting->store_name ?? 'Gamestore Indonesia')

@section('content')
<!-- Hero Section -->
<section class="max-w-7xl mx-auto px-6 pt-0 pb-12 lg:pt-0 lg:pb-16 relative flex flex-col gap-12 lg:gap-16 overflow-hidden">
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
    <div class="relative z-20 mt-3 sm:-mt-6 lg:-mt-10 fade-in">
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
            <div class="px-4 py-2 bg-primary/10 border border-primary/25 rounded-xl flex items-center gap-2 text-primary font-bold text-sm shrink-0 shadow-[0_0_10px_rgba(0,174,239,0.15)]">
                <i class="fas fa-business-time text-xs"></i>
                <span>{{ $setting->operating_hours ?? '09:00 - 22:00 WIB' }}</span>
            </div>
        </div>
    </div>
</section>

<!-- Section Divider -->
<div class="max-w-7xl mx-auto px-6"><div class="border-t border-white/5"></div></div>

<!-- Popular Games -->
<section id="games" class="max-w-7xl mx-auto px-6 py-8 lg:py-12">
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
    <div class="relative group" x-data="gameCarousel()" 
         @touchstart="touchStart($event)" 
         @touchend="touchEnd($event)"
         @wheel="handleWheel($event)"
         @keydown.left="prevPage()"
         @keydown.right="nextPage()"
         tabindex="0"
         class="pt-8 pb-12">
        <!-- Games Grid with Carousel - Hidden overflow for clean edges -->
        <div class="overflow-hidden">
            <div class="flex transition-transform duration-500"
                 :style="{ transform: `translateX(-${currentPage * 100}%)` }">
                <!-- Each page: exactly 4 games -->
                @foreach($games->chunk(4) as $page)
                <div class="w-full flex-shrink-0 flex">
                    <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8 px-6 items-stretch">
                        @foreach($page as $game)
                        <a href="{{ route('game.show', $game->slug) }}" 
                           class="game-card rounded-2xl p-4 flex flex-col relative group game-item transition-all duration-300 will-change-transform"
                           data-categories="{{ json_encode($game->products->pluck('category_id')->unique()->toArray()) }}">
                            <!-- Glow Effect -->
                            <div class="absolute -inset-6 pointer-events-none">
                                <div class="absolute -top-3 -right-3 w-24 h-24 bg-primary/30 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            
                            <!-- Active Badge -->
                            <div class="absolute top-4 left-4 z-20 bg-[#0B101E]/90 backdrop-blur-sm border border-white/10 text-primary text-[10px] font-bold px-3 py-1 rounded-lg tracking-wider uppercase">
                                Active ⚡
                            </div>

                            <!-- Image -->
                            <div class="w-full aspect-[4/5] overflow-hidden rounded-xl mb-4 relative z-10">
                                @if($game->thumbnail && file_exists(public_path('img/' . $game->thumbnail)))
                                    <img src="{{ asset('img/' . $game->thumbnail) }}" alt="{{ $game->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-violet-800 to-indigo-900 flex items-center justify-center transition-transform duration-500 group-hover:scale-105">
                                        <i class="fas fa-gamepad text-white/40 text-5xl"></i>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-bg-dark/80 via-transparent to-transparent opacity-60 group-hover:opacity-40 transition-opacity duration-300"></div>
                            </div>

                            <!-- Content -->
                            <div class="flex-1 flex flex-col relative z-10">
                                <h3 class="text-base font-bold mb-2 group-hover:text-primary transition-colors duration-300 line-clamp-2">{{ $game->name }}</h3>
                                <p class="text-xs text-gray-400 mb-4 flex-grow line-clamp-2 leading-relaxed">{{ $game->description }}</p>
                                
                                <button class="w-full btn-primary py-2.5 rounded-lg text-xs font-bold flex items-center justify-center gap-1.5 shadow-[0_4px_12px_rgba(0,174,239,0.15)] group-hover:shadow-[0_4px_20px_rgba(0,174,239,0.35)] transition-all duration-300">
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
        
        <!-- Pagination Dots -->
        @if($games->count() > 4)
        <div class="flex justify-center gap-2 mt-10">
            <template x-for="(page, index) in totalPages" :key="index">
                <button @click="currentPage = index"
                        :class="currentPage === index ? 'bg-primary w-8' : 'bg-white/30 hover:bg-white/50'"
                        class="h-2.5 rounded-full transition-all duration-300 cursor-pointer"></button>
            </template>
        </div>
        @endif
    </div>

</section>

<!-- Section Divider -->
<div class="max-w-7xl mx-auto px-6"><div class="border-t border-white/5"></div></div>

<!-- Why Choose Us -->
<section id="features" class="max-w-7xl mx-auto px-6 py-8 lg:py-12">
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
</section>

<!-- Section Divider -->
<div class="max-w-7xl mx-auto px-6"><div class="border-t border-white/5"></div></div>

<!-- How to Order -->
<section id="cara-order" class="max-w-7xl mx-auto px-6 py-8 lg:py-12">
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
</section>

<!-- Section Divider -->
<div class="max-w-7xl mx-auto px-6"><div class="border-t border-white/5"></div></div>

<!-- Customer Reviews -->
<section id="testimonials" class="max-w-7xl mx-auto px-6 py-8 lg:py-12">
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
</section>
@endsection
