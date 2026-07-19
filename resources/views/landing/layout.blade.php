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
<body class="landing-body text-white">
    
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
    <!-- REMOVED: Cart functionality no longer needed -->
    
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
        
        function gameCarousel() {
            return {
                currentPage: 0,
                totalPages: Math.ceil(document.querySelectorAll('.game-item').length / 4) || 1,
                touchStartX: 0,
                wheelTimeout: null,
                
                nextPage() {
                    if (this.currentPage < this.totalPages - 1) {
                        this.currentPage++;
                    }
                },
                
                prevPage() {
                    if (this.currentPage > 0) {
                        this.currentPage--;
                    }
                },
                
                touchStart(event) {
                    this.touchStartX = event.touches[0].clientX;
                },
                
                touchEnd(event) {
                    const touchEndX = event.changedTouches[0].clientX;
                    const difference = this.touchStartX - touchEndX;
                    
                    if (difference > 50) {
                        this.nextPage();
                    } else if (difference < -50) {
                        this.prevPage();
                    }
                },
                
                handleWheel(event) {
                    event.preventDefault();
                    
                    // Debounce wheel events
                    if (this.wheelTimeout) {
                        clearTimeout(this.wheelTimeout);
                    }
                    
                    this.wheelTimeout = setTimeout(() => {
                        if (event.deltaY > 0) {
                            this.nextPage();
                        } else if (event.deltaY < 0) {
                            this.prevPage();
                        }
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
    </script>
</body>
</html>
