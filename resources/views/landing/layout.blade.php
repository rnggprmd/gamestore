<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $setting->store_name ?? 'Gamestore Indonesia') - Top Up Game Instan Terpercaya</title>
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/logo gamestore.png') }}">
    
    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Custom styles */
        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }

        * {
            font-family: 'Inter', sans-serif;
        }
        
        h1, h2, h3, .heading-font {
            font-family: 'Montserrat', sans-serif;
        }
        
        .hero-glow {
            text-shadow: 0 0 20px rgba(0, 174, 239, 0.5);
        }
        
        /* WhatsApp Float Button Animation */
        @keyframes pulse-whatsapp {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 20px rgba(37, 211, 102, 0.4);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 30px rgba(37, 211, 102, 0.6);
            }
        }
        
        .whatsapp-float {
            background-color: #25D366;
            animation: pulse-whatsapp 2s ease-in-out infinite;
            transition: all 0.3s ease;
        }
        
        .whatsapp-float:hover {
            animation: none;
            transform: scale(1.1);
            box-shadow: 0 0 40px rgba(37, 211, 102, 0.8);
        }
        
        .whatsapp-tooltip {
            opacity: 0;
            transform: translateX(10px);
            transition: all 0.3s ease;
        }
        
        .whatsapp-tooltip::after {
            content: '';
            position: absolute;
            right: -6px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 6px 0 6px 6px;
            border-color: transparent transparent transparent #ffffff;
        }
        
        .whatsapp-float:hover .whatsapp-tooltip {
            opacity: 1;
            transform: translateX(0);
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #090d16;
        }
        ::-webkit-scrollbar-thumb {
            background: #00AEEF;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #0077B5;
        }
        
        /* Hide scrollbar */
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        
        /* Scroll Animations */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .animate-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Staggered animation delays for children */
        .stagger-animation > * {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }
        
        .stagger-animation.is-visible > *:nth-child(1) { animation: fadeInUp 0.6s ease-out 0.1s forwards; }
        .stagger-animation.is-visible > *:nth-child(2) { animation: fadeInUp 0.6s ease-out 0.2s forwards; }
        .stagger-animation.is-visible > *:nth-child(3) { animation: fadeInUp 0.6s ease-out 0.3s forwards; }
        .stagger-animation.is-visible > *:nth-child(4) { animation: fadeInUp 0.6s ease-out 0.4s forwards; }
        .stagger-animation.is-visible > *:nth-child(5) { animation: fadeInUp 0.6s ease-out 0.5s forwards; }
        .stagger-animation.is-visible > *:nth-child(6) { animation: fadeInUp 0.6s ease-out 0.6s forwards; }
        .stagger-animation.is-visible > *:nth-child(7) { animation: fadeInUp 0.6s ease-out 0.7s forwards; }
        .stagger-animation.is-visible > *:nth-child(8) { animation: fadeInUp 0.6s ease-out 0.8s forwards; }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Fade from left */
        .fade-in-left {
            opacity: 0;
            transform: translateX(-40px);
            transition: opacity 0.7s ease-out, transform 0.7s ease-out;
        }
        
        .fade-in-left.is-visible {
            opacity: 1;
            transform: translateX(0);
        }
        
        /* Fade from right */
        .fade-in-right {
            opacity: 0;
            transform: translateX(40px);
            transition: opacity 0.7s ease-out, transform 0.7s ease-out;
        }
        
        .fade-in-right.is-visible {
            opacity: 1;
            transform: translateX(0);
        }
        
        /* Scale up animation */
        .scale-in {
            opacity: 0;
            transform: scale(0.9);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .scale-in.is-visible {
            opacity: 1;
            transform: scale(1);
        }
        
        /* Character Animation */
        .character-float {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-15px);
            }
        }
        
        .character-glow {
            position: relative;
        }
        
        .character-glow::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 80%;
            height: 60%;
            background: radial-gradient(ellipse, rgba(0, 174, 239, 0.15) 0%, transparent 70%);
            transform: translate(-50%, -50%);
            border-radius: 50%;
            animation: pulse-glow 4s ease-in-out infinite;
            z-index: -1;
        }
        
        @keyframes pulse-glow {
            0%, 100% {
                opacity: 0.3;
                transform: translate(-50%, -50%) scale(1);
            }
            50% {
                opacity: 0.6;
                transform: translate(-50%, -50%) scale(1.1);
            }
        }
    </style>
</head>
<body x-data="globalCartStore('{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}')" @toggle-cart.window="isCartOpen = !isCartOpen" @add-to-cart.window="addToCart($event.detail)" class="landing-body text-white">
    
    <!-- Floating WhatsApp Button -->
    @if($setting->whatsapp)
    <button @click="contactAdmin()"
       class="whatsapp-float fixed bottom-6 right-6 z-50 w-14 h-14 rounded-full flex items-center justify-center text-white text-3xl group"
       type="button">
        <i class="fab fa-whatsapp"></i>
        <!-- Tooltip -->
        <span class="whatsapp-tooltip absolute right-full mr-4 top-1/2 -translate-y-1/2 bg-white text-gray-800 px-4 py-2.5 rounded-lg text-sm font-semibold whitespace-nowrap shadow-xl">
            Hubungi Admin
        </span>
    </button>
    @endif
    
    <!-- Header -->
    <header class="fixed w-full top-0 z-50 bg-bg-dark/90 backdrop-blur-md border-b border-white/10 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <img src="{{ asset('img/logo gamestore.png') }}" alt="{{ $setting->store_name ?? 'Gamestore' }} Logo" class="w-8 h-8 rounded-full">
                <span class="text-xl font-heading font-bold uppercase tracking-wider">{{ $setting->store_name ?? 'Gamestore' }}</span>
            </div>
            
            <!-- Navigation (Desktop) -->
            <nav class="hidden lg:flex items-center gap-6 text-sm font-medium text-gray-300">
                <a href="{{ route('home') }}" class="text-primary hover:text-white transition-colors">Beranda</a>
                <a href="{{ route('home') }}#games" class="hover:text-white transition-colors">Daftar Game</a>
                <a href="{{ route('home') }}#features" class="hover:text-white transition-colors">Tentang Kami</a>
                <a href="{{ route('home') }}#cara-order" class="hover:text-white transition-colors">Cara Order</a>
                <a href="{{ route('home') }}#testimonials" class="hover:text-white transition-colors">Ulasan</a>
            </nav>
            
            <!-- Actions -->
            <div class="flex items-center gap-4">
                <!-- Cart Button -->
                <button @click.stop="$dispatch('toggle-cart')" class="relative bg-white/5 hover:bg-white/10 border border-white/10 w-10 h-10 rounded-full flex items-center justify-center text-gray-300 hover:text-white transition-all cursor-pointer">
                    <i class="fas fa-shopping-cart text-sm"></i>
                    <span x-show="cartCount > 0" x-text="cartCount" class="absolute -top-1 -right-1 bg-primary text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center border-2 border-bg-dark shadow-sm"></span>
                </button>

                <a href="{{ route('home') }}#games" class="hidden md:flex items-center gap-2 bg-primary hover:bg-primary/90 px-6 py-2 rounded-full text-white font-semibold text-sm transition-colors">
                    <span>Beli Sekarang</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="pt-16 lg:pt-20">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-[#060812] border-t border-white/10 pt-16 pb-8 px-6 relative overflow-hidden">
        <!-- Subtle footer lighting backdrop -->
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-primary/5 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12 mb-16 relative z-10">
            <!-- Brand Column -->
            <div class="flex flex-col gap-5">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/logo gamestore.png') }}" alt="{{ $setting->store_name ?? 'Gamestore' }} Logo" class="w-9 h-9 rounded-full shadow-lg border border-white/10">
                    <span class="text-xl font-heading font-black uppercase tracking-wider text-white">
                        {{ $setting->store_name ?? 'Gamestore' }}<span class="text-primary">.</span>
                    </span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
                    {{ $setting->footer ?? 'Penyedia layanan top up game online instan, murah, aman, dan terpercaya di Indonesia. Otomatis 24 Jam.' }}
                </p>
                @if($setting->address)
                <div class="flex items-start gap-3 text-gray-400 text-sm mt-2">
                    <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-primary shrink-0 border border-white/5">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <span class="leading-snug pt-0.5">{{ $setting->address }}</span>
                </div>
                @endif
            </div>
            
            <!-- Navigasi & Bantuan Wrapper (Side-by-side on mobile) -->
            <div class="grid grid-cols-2 gap-6 sm:contents">
                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-bold mb-6 text-sm uppercase tracking-wider flex items-center gap-2">
                        <span class="w-1.5 h-3 bg-primary rounded-full"></span>
                        Navigasi
                    </h4>
                    <ul class="flex flex-col gap-3.5">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-primary transition-colors text-sm flex items-center gap-1.5 group"><i class="fas fa-chevron-right text-[9px] text-gray-600 group-hover:text-primary transition-colors"></i> Beranda</a></li>
                        <li><a href="{{ route('home') }}#games" class="text-gray-400 hover:text-primary transition-colors text-sm flex items-center gap-1.5 group"><i class="fas fa-chevron-right text-[9px] text-gray-600 group-hover:text-primary transition-colors"></i> Daftar Game</a></li>
                        <li><a href="{{ route('home') }}#features" class="text-gray-400 hover:text-primary transition-colors text-sm flex items-center gap-1.5 group"><i class="fas fa-chevron-right text-[9px] text-gray-600 group-hover:text-primary transition-colors"></i> Mengapa Kami</a></li>
                        <li><a href="{{ route('home') }}#cara-order" class="text-gray-400 hover:text-primary transition-colors text-sm flex items-center gap-1.5 group"><i class="fas fa-chevron-right text-[9px] text-gray-600 group-hover:text-primary transition-colors"></i> Cara Order</a></li>
                        <li><a href="{{ route('home') }}#testimonials" class="text-gray-400 hover:text-primary transition-colors text-sm flex items-center gap-1.5 group"><i class="fas fa-chevron-right text-[9px] text-gray-600 group-hover:text-primary transition-colors"></i> Testimoni</a></li>
                    </ul>
                </div>
                
                <!-- Support -->
                <div>
                    <h4 class="text-white font-bold mb-6 text-sm uppercase tracking-wider flex items-center gap-2">
                        <span class="w-1.5 h-3 bg-primary rounded-full"></span>
                        Bantuan
                    </h4>
                    <ul class="flex flex-col gap-3.5">
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors text-sm flex items-center gap-1.5 group"><i class="fas fa-chevron-right text-[9px] text-gray-600 group-hover:text-primary transition-colors"></i> Hubungi CS</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors text-sm flex items-center gap-1.5 group"><i class="fas fa-chevron-right text-[9px] text-gray-600 group-hover:text-primary transition-colors"></i> Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors text-sm flex items-center gap-1.5 group"><i class="fas fa-chevron-right text-[9px] text-gray-600 group-hover:text-primary transition-colors"></i> Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors text-sm flex items-center gap-1.5 group"><i class="fas fa-chevron-right text-[9px] text-gray-600 group-hover:text-primary transition-colors"></i> Metode Pembayaran</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Contact -->
            <div class="flex flex-col gap-5">
                <h4 class="text-white font-bold text-sm uppercase tracking-wider flex items-center gap-2">
                    <span class="w-1.5 h-3 bg-primary rounded-full"></span>
                    Sosial Media
                </h4>
                <div class="flex gap-3">
                    @if($setting->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center text-gray-400 border border-white/10 hover:bg-emerald-600 hover:text-white hover:border-transparent transition-all duration-300">
                        <i class="fab fa-whatsapp text-lg"></i>
                    </a>
                    @endif
                    @if($setting->instagram)
                    <a href="{{ $setting->instagram }}" target="_blank" class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center text-gray-400 border border-white/10 hover:bg-gradient-to-tr hover:from-amber-500 hover:via-red-500 hover:to-purple-600 hover:text-white hover:border-transparent transition-all duration-300">
                        <i class="fab fa-instagram text-lg"></i>
                    </a>
                    @endif
                    @if($setting->facebook)
                    <a href="{{ $setting->facebook }}" target="_blank" class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center text-gray-400 border border-white/10 hover:bg-blue-600 hover:text-white hover:border-transparent transition-all duration-300">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </a>
                    @endif
                </div>
                @if($setting->whatsapp_channel)
                <a href="{{ $setting->whatsapp_channel }}" target="_blank" class="w-full bg-primary/10 border border-primary/25 hover:border-primary text-primary py-3 rounded-xl font-bold text-xs hover:bg-primary hover:text-white transition-all flex items-center justify-center gap-2">
                    <i class="fas fa-bullhorn"></i> Gabung Saluran WA
                </a>
                @endif
            </div>
        </div>
        
        <!-- Copyright / Payment Methods logos -->
        <div class="max-w-7xl mx-auto pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6 relative z-10">
            <p class="text-gray-500 text-xs tracking-wide">&copy; {{ date('Y') }} {{ $setting->store_name ?? 'Gamestore' }}. All rights reserved.</p>
        </div>
    </footer>
    
    <!-- Shopping Cart Drawer Side Panel -->
    <div x-show="isCartOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-hidden" 
         style="display: none;">
        
        <!-- Backdrop overlay -->
        <div @click.stop="isCartOpen = false" class="absolute inset-0 bg-black/70 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
            <div x-show="isCartOpen"
                 x-transition:enter="transform transition ease-in-out duration-300 sm:duration-500"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transform transition ease-in-out duration-300 sm:duration-500"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 class="w-screen max-w-md bg-[#0D1322] border-l border-white/10 shadow-2xl flex flex-col justify-between">
                
                <!-- Drawer Header -->
                <div class="p-6 border-b border-white/10 flex items-center justify-between bg-bg-card">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-primary/10 border border-primary/20 flex items-center justify-center text-primary">
                            <i class="fas fa-shopping-cart text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-white">Keranjang Belanja</h3>
                            <p class="text-xs text-gray-400" x-text="cartCount + ' Item Dipilih'"></p>
                        </div>
                    </div>
                    <button @click.stop="isCartOpen = false" class="w-8 h-8 rounded-full bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white flex items-center justify-center transition-colors cursor-pointer">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </div>

                <!-- Drawer Content / Items List -->
                <div class="flex-1 overflow-y-auto p-6 space-y-4">
                    <template x-if="cartItems.length === 0">
                        <div class="h-full flex flex-col items-center justify-center text-center py-16 text-gray-500">
                            <div class="w-20 h-20 rounded-full bg-white/5 flex items-center justify-center mb-4 text-3xl text-gray-600">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <h4 class="text-sm font-bold text-gray-300 mb-1">Keranjang Masih Kosong</h4>
                            <p class="text-xs text-gray-500 max-w-xs">Pilih game favoritmu dan tambahkan beberapa produk ke keranjang belanja.</p>
                        </div>
                    </template>

                    <template x-for="(item, index) in cartItems" :key="index">
                        <div class="bg-bg-card border border-white/10 rounded-2xl p-4 flex flex-col gap-3 relative group">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-primary px-2 py-0.5 rounded bg-primary/10 border border-primary/20" x-text="item.gameName"></span>
                                    <h4 class="text-sm font-bold text-white mt-1.5" x-text="item.productName"></h4>
                                </div>
                                <button @click="removeItem(index)" class="text-gray-500 hover:text-rose-400 text-xs transition-colors p-1 cursor-pointer">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>

                            <!-- Account info badge -->
                            <div class="bg-bg-dark/80 rounded-xl p-2.5 text-xs text-gray-300 space-y-1 font-mono border border-white/5">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">User:</span>
                                    <span class="font-bold text-white" x-text="item.username"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">ID/UID:</span>
                                    <span class="font-bold text-white" x-text="item.uid"></span>
                                </div>
                                <template x-if="item.server">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Server:</span>
                                        <span class="font-bold text-white" x-text="item.server"></span>
                                    </div>
                                </template>
                            </div>

                            <!-- Price & Qty Row -->
                            <div class="flex items-center justify-between pt-1">
                                <span class="text-xs font-bold text-primary" x-text="formatRupiah(item.price * item.quantity)"></span>
                                
                                <div class="flex items-center gap-2 bg-bg-dark border border-white/10 rounded-lg p-1">
                                    <button @click="updateQty(index, -1)" class="w-6 h-6 rounded flex items-center justify-center bg-white/5 text-gray-300 hover:text-white text-xs cursor-pointer">-</button>
                                    <span class="text-xs font-bold text-white px-1" x-text="item.quantity"></span>
                                    <button @click="updateQty(index, 1)" class="w-6 h-6 rounded flex items-center justify-center bg-white/5 text-gray-300 hover:text-white text-xs cursor-pointer">+</button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Drawer Footer & Checkout -->
                <div x-show="cartItems.length > 0" class="p-6 border-t border-white/10 bg-bg-card space-y-4">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-400">Total Harga</span>
                        <span class="text-xl font-black text-white" x-text="formatRupiah(cartTotal)"></span>
                    </div>

                    <button @click="checkoutWhatsApp()" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3.5 rounded-xl flex items-center justify-center gap-2 transition-all shadow-lg shadow-emerald-600/20 cursor-pointer">
                        <i class="fab fa-whatsapp text-lg"></i>
                        <span>Checkout Semua via WhatsApp</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script>
        // Scroll Animation Observer
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        // Optional: unobserve after animation to improve performance
                        // observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);
            
            // Observe all elements with animation classes
            const animatedElements = document.querySelectorAll('.animate-on-scroll, .stagger-animation, .fade-in-left, .fade-in-right, .scale-in');
            animatedElements.forEach(el => observer.observe(el));
        });
    </script>

    <!-- Game Filter & Carousel Script -->
    <script>
        function gameFilter() {
            return {
                selectedCategory: 'all',
                
                filterGames() {
                    const gameItems = document.querySelectorAll('.game-item');
                    
                    gameItems.forEach(item => {
                        const categories = JSON.parse(item.dataset.categories);
                        const isVisible = this.selectedCategory === 'all' || categories.includes(parseInt(this.selectedCategory));
                        
                        if (isVisible) {
                            item.classList.remove('hidden', 'opacity-0');
                            item.classList.add('animate-fadeIn');
                        } else {
                            item.classList.add('hidden', 'opacity-0');
                        }
                    });
                }
            };
        }
        
        function gameCarouselMobile() {
            return {
                currentPage: 0,
                totalPages: {{ $games->count() }},
                touchStartX: 0,

                nextPage() {
                    if (this.currentPage < this.totalPages - 1) this.currentPage++;
                },
                prevPage() {
                    if (this.currentPage > 0) this.currentPage--;
                },
                touchStart(event) {
                    this.touchStartX = event.touches[0].clientX;
                },
                touchEnd(event) {
                    const diff = this.touchStartX - event.changedTouches[0].clientX;
                    if (diff > 50) this.nextPage();
                    else if (diff < -50) this.prevPage();
                }
            };
        }

        function gameCarouselDesktop() {
            return {
                currentPage: 0,
                totalPages: {{ $games->chunk(4)->count() }},
                wheelTimeout: null,

                nextPage() {
                    if (this.currentPage < this.totalPages - 1) this.currentPage++;
                },
                prevPage() {
                    if (this.currentPage > 0) this.currentPage--;
                },
                handleWheel(event) {
                    event.preventDefault();
                    if (this.wheelTimeout) clearTimeout(this.wheelTimeout);
                    this.wheelTimeout = setTimeout(() => {
                        if (event.deltaY > 0) this.nextPage();
                        else if (event.deltaY < 0) this.prevPage();
                    }, 100);
                }
            };
        }
        
        function gameSearchFilter() {
            return {
                searchQuery: '',
                
                filterBySearch() {
                    const gameItems = document.querySelectorAll('.game-item');
                    const query = this.searchQuery.toLowerCase();
                    
                    gameItems.forEach(item => {
                        const gameName = item.querySelector('h3').textContent.toLowerCase();
                        const gameDesc = item.querySelector('p').textContent.toLowerCase();
                        const isVisible = gameName.includes(query) || gameDesc.includes(query) || query === '';
                        
                        if (isVisible) {
                            item.classList.remove('hidden', 'opacity-0');
                            item.classList.add('animate-fadeIn');
                        } else {
                            item.classList.add('hidden', 'opacity-0');
                        }
                    });
                }
            };
        }
        
        // Add fadeIn animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: scale(0.95);
                }
                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }
            .animate-fadeIn {
                animation: fadeIn 0.3s ease-out;
            }
        `;
        document.head.appendChild(style);
        function globalCartStore(waNumber) {
            return {
                isCartOpen: false,
                waNumber: waNumber,
                cartItems: JSON.parse(localStorage.getItem('gamestore_cart') || '[]'),

                get cartCount() {
                    return this.cartItems.reduce((sum, item) => sum + item.quantity, 0);
                },

                get cartTotal() {
                    return this.cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                },

                saveCart() {
                    localStorage.setItem('gamestore_cart', JSON.stringify(this.cartItems));
                },

                addToCart(item) {
                    let existingIndex = this.cartItems.findIndex(i => 
                        i.gameId === item.gameId && 
                        i.productId === item.productId && 
                        i.uid === item.uid && 
                        i.server === item.server
                    );

                    if (existingIndex > -1) {
                        this.cartItems[existingIndex].quantity += item.quantity;
                    } else {
                        this.cartItems.push(item);
                    }
                    this.saveCart();
                    this.isCartOpen = true;
                },

                removeItem(index) {
                    this.cartItems.splice(index, 1);
                    this.saveCart();
                },

                updateQty(index, delta) {
                    let next = this.cartItems[index].quantity + delta;
                    if (next > 0) {
                        this.cartItems[index].quantity = next;
                    } else {
                        this.cartItems.splice(index, 1);
                    }
                    this.saveCart();
                },

                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }).format(number);
                },

                replaceTemplate(text, replacements) {
                    let formatted = text;
                    for (const [key, value] of Object.entries(replacements)) {
                        const regex = new RegExp('(?:\\{\\{\\s*|\\{\\s*|\\[\\s*)' + key + '(?:\\s*\\}\\}|\\s*\\}|\\s*\\])', 'gi');
                        formatted = formatted.replace(regex, value);
                    }
                    return formatted;
                },

                checkoutWhatsApp() {
                    if (this.cartItems.length === 0) return;

                    let msg;

                    if (this.cartItems.length === 1) {
                        // Single item template
                        const item = this.cartItems[0];
                        const templateSingle = `{{ $setting->whatsapp_template_single ?? '' }}`;
                        const storeName = '{{ $setting->store_name }}' || 'Gamestore';
                        
                        if (templateSingle) {
                            msg = this.replaceTemplate(templateSingle, {
                                'STORE_NAME': storeName,
                                'GAME_NAME': item.gameName,
                                'PRODUCT_NAME': item.productName,
                                'USERNAME': item.username,
                                'UID': item.uid,
                                'PRICE': this.formatRupiah(item.price * item.quantity),
                                'TOTAL': this.formatRupiah(item.price * item.quantity)
                            });
                        } else {
                            // Fallback default template for single item
                            msg = `*PESANAN - ${storeName}*\n`;
                            msg += `=================================\n\n`;
                            msg += `*${item.gameName}*\n`;
                            msg += `• Produk: *${item.productName}*\n`;
                            msg += `• Username: *${item.username}*\n`;
                            msg += `• UID/ID: *${item.uid}*\n`;
                            msg += `• Jumlah: ${item.quantity}x\n`;
                            msg += `• Harga: ${this.formatRupiah(item.price)}\n\n`;
                            msg += `=================================\n`;
                            msg += `*TOTAL: ${this.formatRupiah(item.price * item.quantity)}*\n`;
                            msg += `=================================\n\n`;
                            msg += `Terima kasih! 🙏`;
                        }
                    } else {
                        // Multiple items template
                        const templateMultiple = `{{ $setting->whatsapp_template_multiple ?? '' }}`;
                        const storeName = '{{ $setting->store_name }}' || 'Gamestore';
                        
                        let itemsMsg = '';
                        this.cartItems.forEach((item, index) => {
                            itemsMsg += `*${index + 1}. ${item.gameName}*\n`;
                            itemsMsg += `   - Produk: ${item.productName}\n`;
                            itemsMsg += `   - Username: *${item.username}*\n`;
                            itemsMsg += `   - UID/ID: *${item.uid}*\n`;
                            itemsMsg += `   - Jumlah: ${item.quantity}x @ ${this.formatRupiah(item.price)}\n`;
                            itemsMsg += `   - Subtotal: *${this.formatRupiah(item.price * item.quantity)}*\n\n`;
                        });

                        if (templateMultiple) {
                            msg = this.replaceTemplate(templateMultiple, {
                                'STORE_NAME': storeName,
                                'ITEMS': itemsMsg,
                                'TOTAL': this.formatRupiah(this.cartTotal)
                            });
                        } else {
                            // Fallback default template for multiple items
                            msg = `*PESANAN MULTI ITEM (KERANJANG)*\n`;
                            msg += `=================================\n\n`;
                            msg += itemsMsg;
                            msg += `=================================\n`;
                            msg += `*TOTAL PEMBAYARAN: ${this.formatRupiah(this.cartTotal)}*\n`;
                            msg += `=================================\n\n`;
                            msg += `Mohon segera diproses pesanan ini. Terima kasih! 🙏`;
                        }
                    }

                    // Log click
                    fetch('/log-click', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    }).catch(err => console.error('Click log failed', err));

                    let url = `https://wa.me/${this.waNumber}?text=${encodeURIComponent(msg)}`;
                    window.open(url, '_blank');
                },

                contactAdmin() {
                    const template = `{{ $setting->whatsapp_contact_template ?? '' }}`;
                    const storeName = '{{ $setting->store_name }}' || 'Gamestore';
                    
                    let msg;
                    if (template) {
                        msg = this.replaceTemplate(template, {
                            'STORE_NAME': storeName
                        });
                    } else {
                        // Fallback default contact message
                        msg = `Halo ${storeName}, saya ingin bertanya tentang produk Anda.\n\nMohon bantu saya. Terima kasih! 🙏`;
                    }

                    let url = `https://wa.me/${this.waNumber}?text=${encodeURIComponent(msg)}`;
                    window.open(url, '_blank');
                }
            };
        }
    </script>
</body>
</html>
