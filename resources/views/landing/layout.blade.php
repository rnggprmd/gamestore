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
<body class="landing-body text-white" x-data="cartHandler()" x-init="initCart()">
    
    <!-- Floating WhatsApp Button -->
    @if($setting->whatsapp)
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}?text=Halo%20{{ urlencode($setting->store_name ?? 'Gamestore') }}"
       class="whatsapp-float fixed bottom-6 right-6 z-50 w-14 h-14 rounded-full flex items-center justify-center text-white text-3xl group"
       target="_blank" rel="noopener noreferrer">
        <i class="fab fa-whatsapp"></i>
        <!-- Tooltip -->
        <span class="whatsapp-tooltip absolute right-full mr-4 top-1/2 -translate-y-1/2 bg-white text-gray-800 px-4 py-2.5 rounded-lg text-sm font-semibold whitespace-nowrap shadow-xl">
            Hubungi Admin
        </span>
    </a>
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
            <div class="flex items-center gap-5">
                <!-- Cart Button -->
                <button @click="openCart = true" class="text-gray-300 hover:text-white transition-colors relative">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span x-show="cart.length > 0" x-text="cartTotalQuantity()" class="absolute -top-2 -right-2 bg-primary text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">0</span>
                </button>
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
            
            <div class="flex items-center gap-4 flex-wrap justify-center opacity-40 grayscale hover:opacity-85 hover:grayscale-0 transition-all duration-500">
                <span class="text-[9px] uppercase tracking-widest text-gray-500 font-bold mr-2">Metode Pembayaran Aman</span>
                <i class="fab fa-cc-visa text-2xl text-white"></i>
                <i class="fab fa-cc-mastercard text-2xl text-white"></i>
                <i class="fab fa-cc-paypal text-2xl text-white"></i>
                <span class="text-xs font-black text-white font-mono">QRIS</span>
                <span class="text-xs font-black text-white font-mono">E-WALLET</span>
            </div>
        </div>
    </footer>
    
    <!-- Shopping Cart Drawer -->
    <div x-cloak x-show="openCart" class="fixed inset-0 z-50 overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="absolute inset-0 overflow-hidden">
            <!-- Background Backdrop -->
            <div x-show="openCart" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="openCart = false" class="absolute inset-0 bg-bg-dark/70 backdrop-blur-sm transition-opacity"></div>
            
            <!-- Drawer Container -->
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div x-show="openCart" x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="pointer-events-auto w-screen max-w-md">
                    <div class="flex h-full flex-col overflow-y-scroll bg-[#0b0f19] border-l border-white/10 shadow-2xl">
                        <!-- Drawer Header -->
                        <div class="flex items-center justify-between px-6 py-6 border-b border-white/10 bg-[#090d16]">
                            <h2 class="text-lg font-bold text-white flex items-center gap-2">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                Keranjang Belanja
                            </h2>
                            <button @click="openCart = false" class="p-2 rounded-lg bg-bg-card hover:bg-[#1a2030] text-gray-400 hover:text-white transition-colors cursor-pointer border border-white/10">
                                <i class="fas fa-times text-lg"></i>
                            </button>
                        </div>
                        
                        <!-- Drawer Body -->
                        <div class="flex-1 py-6 overflow-y-auto px-6 space-y-4">
                            <!-- Empty Cart State -->
                            <template x-if="cart.length === 0">
                                <div class="h-full flex flex-col items-center justify-center text-center py-12">
                                    <div class="w-16 h-16 rounded-full bg-bg-card border border-white/10 flex items-center justify-center mb-4 text-gray-600">
                                        <i class="fas fa-shopping-bag text-3xl"></i>
                                    </div>
                                    <h3 class="text-sm font-semibold text-gray-300">Keranjang Kosong</h3>
                                    <p class="mt-1 text-xs text-gray-500 max-w-[240px]">Belum ada produk yang ditambahkan. Silakan pilih produk game Anda terlebih dahulu.</p>
                                    <a @click="openCart = false" href="{{ route('home') }}#games" class="mt-6 inline-flex items-center justify-center btn-primary text-white font-semibold text-xs py-2.5 px-6 rounded-xl transition-all cursor-pointer">
                                        Lihat Produk Game
                                    </a>
                                </div>
                            </template>
                            
                            <!-- Cart Items List -->
                            <template x-if="cart.length > 0">
                                <div class="space-y-4">
                                    <template x-for="(item, index) in cart" :key="index">
                                        <div class="bg-bg-card/60 border border-white/10 rounded-2xl p-4 flex gap-4 relative overflow-hidden">
                                            <!-- Remove Item Button -->
                                            <button @click="removeItem(index)" class="absolute top-2 right-2 p-1.5 rounded-lg bg-red-950/20 text-red-400 hover:bg-red-950/60 hover:text-red-300 transition-colors border border-red-900/10 cursor-pointer">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                            
                                            <!-- Content -->
                                            <div class="flex-grow space-y-2">
                                                <div class="pr-6">
                                                    <h4 class="text-sm font-bold text-white" x-text="item.gameName"></h4>
                                                    <p class="text-xs text-gray-400" x-text="item.productName"></p>
                                                </div>
                                                
                                                <!-- Order Meta -->
                                                <div class="grid grid-cols-2 gap-x-2 gap-y-1 bg-bg-dark/50 rounded-lg p-2 text-[10px] text-gray-400">
                                                    <div>Username: <span class="text-gray-200 font-medium" x-text="item.username"></span></div>
                                                    <div>UID: <span class="text-gray-200 font-medium" x-text="item.uid"></span></div>
                                                    <template x-if="item.server">
                                                        <div class="col-span-2">Server: <span class="text-gray-200 font-medium" x-text="item.server"></span></div>
                                                    </template>
                                                </div>
                                                
                                                <!-- Price & Qty Actions -->
                                                <div class="flex items-center justify-between pt-2">
                                                    <span class="text-xs font-semibold text-primary" x-text="formatRupiah(item.price * item.quantity)"></span>
                                                    
                                                    <!-- Quantity Control -->
                                                    <div class="flex items-center gap-1 bg-bg-dark rounded-lg p-1 border border-white/10">
                                                        <button @click="updateQty(index, -1)" class="w-6 h-6 flex items-center justify-center rounded bg-bg-card hover:bg-[#1a2030] text-gray-400 hover:text-white transition-all text-xs font-bold cursor-pointer">-</button>
                                                        <span class="w-6 text-center text-xs font-bold text-white" x-text="item.quantity"></span>
                                                        <button @click="updateQty(index, 1)" class="w-6 h-6 flex items-center justify-center rounded bg-bg-card hover:bg-[#1a2030] text-gray-400 hover:text-white transition-all text-xs font-bold cursor-pointer">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </div>
                        
                        <!-- Drawer Footer -->
                        <template x-if="cart.length > 0">
                            <div class="border-t border-white/10 bg-[#090d16] px-6 py-6 space-y-6">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-400 font-medium">Total Harga</span>
                                    <span class="text-lg font-bold text-white" x-text="formatRupiah(cartTotalSum())"></span>
                                </div>
                                <button @click="checkoutWhatsApp()" class="w-full flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3.5 px-6 rounded-2xl transition-all shadow-lg shadow-emerald-600/10 cursor-pointer">
                                    <i class="fab fa-whatsapp text-xl"></i>
                                    Checkout via WhatsApp
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script>
        function cartHandler() {
            return {
                cart: [],
                openCart: false,
                storeWhatsapp: '{{ preg_replace('/[^0-9]/', '', $setting->whatsapp ?? '') }}',
                storeName: '{{ $setting->store_name ?? 'Gamestore' }}',
                
                initCart() {
                    let savedCart = localStorage.getItem('gamestore_cart');
                    if (savedCart) {
                        try {
                            this.cart = JSON.parse(savedCart);
                        } catch(e) {
                            this.cart = [];
                        }
                    }
                    this.$watch('cart', value => {
                        localStorage.setItem('gamestore_cart', JSON.stringify(value));
                    });
                },
                
                addToCart(item) {
                    let existingIndex = this.cart.findIndex(i => 
                        i.productId === item.productId && 
                        i.username === item.username && 
                        i.uid === item.uid && 
                        i.server === item.server
                    );
                    
                    if (existingIndex !== -1) {
                        this.cart[existingIndex].quantity += item.quantity;
                    } else {
                        this.cart.push(item);
                    }
                    
                    this.openCart = true;
                },
                
                removeItem(index) {
                    this.cart.splice(index, 1);
                },
                
                updateQty(index, delta) {
                    let newQty = this.cart[index].quantity + delta;
                    if (newQty > 0) {
                        this.cart[index].quantity = newQty;
                    } else {
                        this.removeItem(index);
                    }
                },
                
                cartTotalQuantity() {
                    return this.cart.reduce((sum, item) => sum + item.quantity, 0);
                },
                
                cartTotalSum() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                },
                
                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }).format(number);
                },
                
                checkoutWhatsApp() {
                    if (this.cart.length === 0) return;
                    
                    let message = `*PESANAN BARU - ${this.storeName.toUpperCase()}*\n`;
                    message += `=================================\n`;
                    message += `*Detail Pesanan:*\n\n`;
                    
                    this.cart.forEach((item, index) => {
                        let idx = index + 1;
                        message += `${idx}. *${item.gameName}*\n`;
                        message += `   - Item: ${item.productName} (x${item.quantity})\n`;
                        message += `   - Username: *${item.username}*\n`;
                        message += `   - UID / ID Game: *${item.uid}*\n`;
                        if (item.server) {
                            message += `   - Server: *${item.server}*\n`;
                        }
                        message += `   - Harga: ${this.formatRupiah(item.price)}\n`;
                        message += `   - Subtotal: ${this.formatRupiah(item.price * item.quantity)}\n\n`;
                    });
                    
                    message += `=================================\n`;
                    message += `*TOTAL TAGIHAN: ${this.formatRupiah(this.cartTotalSum())}*\n`;
                    message += `=================================\n\n`;
                    message += `Mohon segera diproses dan kirimkan instruksi pembayarannya. Terima kasih!`;
                    
                    let url = `https://wa.me/${this.storeWhatsapp}?text=${encodeURIComponent(message)}`;
                    window.open(url, '_blank');
                }
            };
        }
        
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
</body>
</html>
