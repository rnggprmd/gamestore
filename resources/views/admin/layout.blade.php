<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panel Admin - {{ $setting->store_name ?? 'Gamestore' }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Scrollbar Styling -->
    <style>
        /* Scrollbar styling for sidebar */
        aside::-webkit-scrollbar {
            width: 8px;
        }

        aside::-webkit-scrollbar-track {
            background: transparent;
        }

        aside::-webkit-scrollbar-thumb {
            background: #00E5FF;
            border-radius: 4px;
        }

        aside::-webkit-scrollbar-thumb:hover {
            background: #00D9F1;
        }

        /* For Firefox */
        aside {
            scrollbar-color: #00E5FF transparent;
            scrollbar-width: thin;
        }

        /* Main content scrollbar */
        main::-webkit-scrollbar {
            width: 8px;
        }

        main::-webkit-scrollbar-track {
            background: transparent;
        }

        main::-webkit-scrollbar-thumb {
            background: #00E5FF;
            border-radius: 4px;
        }

        main::-webkit-scrollbar-thumb:hover {
            background: #00D9F1;
        }

        /* For Firefox */
        main {
            scrollbar-color: #00E5FF transparent;
            scrollbar-width: thin;
        }
    </style>
</head>
<body class="bg-watt-bg text-white h-screen overflow-hidden flex flex-col">
    <!-- Main Outer Wrapper -->
    <div class="flex flex-1 overflow-hidden">
        
        <!-- Sidebar (Desktop) -->
        <aside class="hidden lg:flex flex-col w-64 bg-watt-surface text-watt-text-sec border-r border-watt-border">
            <!-- Sidebar Header -->
            <div class="h-28 flex items-center justify-center px-6 pt-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <img src="{{ asset('img/logo gamestore.png') }}" alt="Gamestore Logo" class="h-20 w-auto">
                </a>
            </div>

            <!-- Sidebar Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 hover:translate-x-1 {{ request()->routeIs('admin.dashboard') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    Dashboard
                </a>

                <a href="{{ route('admin.games.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 hover:translate-x-1 {{ request()->routeIs('admin.games.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                    <i data-lucide="gamepad-2" class="w-4 h-4"></i>
                    Manajemen Game
                </a>

                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 hover:translate-x-1 {{ request()->routeIs('admin.products.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                    <i data-lucide="package" class="w-4 h-4"></i>
                    Manajemen Produk
                </a>

                <a href="{{ route('admin.banners.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 hover:translate-x-1 {{ request()->routeIs('admin.banners.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                    <i data-lucide="image" class="w-4 h-4"></i>
                    Manajemen Banner
                </a>

                <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 hover:translate-x-1 {{ request()->routeIs('admin.testimonials.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                    <i data-lucide="message-square" class="w-4 h-4"></i>
                    Ulasan / Testimoni
                </a>

                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 hover:translate-x-1 {{ request()->routeIs('admin.settings.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                    <i data-lucide="settings" class="w-4 h-4"></i>
                    Pengaturan Toko
                </a>
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-watt-border space-y-2">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg text-xs font-semibold bg-watt-hover text-watt-text-sec hover:bg-[#333] hover:text-white transition-all">
                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                    Lihat Website
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-xs font-semibold bg-watt-alert-bg text-watt-red hover:bg-[#4A2C2C] hover:text-white transition-all text-left cursor-pointer">
                        <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Top Navbar (Mobile toggle & Header title) -->
            <header class="h-16 bg-watt-surface border-b border-watt-border flex items-center justify-between px-6 z-20">
                <div class="flex items-center gap-4">
                    <!-- Mobile Sidebar Toggle -->
                    <button id="mobile-toggle" class="lg:hidden p-2 rounded-lg hover:bg-watt-hover text-watt-text-sec hover:text-white">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>
                    <h2 class="text-2xl font-semibold font-sans text-white">@yield('page_title', 'Admin Panel')</h2>
                </div>

                <!-- Admin user badge -->
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex flex-col text-right">
                        <span class="text-xs font-bold text-white">{{ Auth::user()->name }}</span>
                        <span class="text-[10px] text-watt-text-sec">Administrator</span>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-watt-cyan flex items-center justify-center text-watt-bg font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Page Main Content Body -->
            <main class="flex-1 overflow-y-auto p-6 bg-watt-bg">
                <!-- Success Alert -->
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-[16px] bg-[#1A2C22] border-l-4 border-watt-green text-watt-green text-xs font-semibold flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Drawer Sidebar menu (Dynamic overlay toggle) -->
    <div id="mobile-sidebar" class="hidden fixed inset-0 z-50 overflow-hidden" role="dialog" aria-modal="true">
        <div class="absolute inset-0 overflow-hidden">
            <!-- Overlay -->
            <div id="mobile-overlay" class="absolute inset-0 bg-watt-bg/80 backdrop-blur-sm transition-opacity"></div>
            <!-- Menu container -->
            <div class="absolute inset-y-0 left-0 max-w-full flex">
                <div class="w-64 bg-watt-surface text-watt-text-sec flex flex-col h-full">
                    <div class="h-16 flex items-center justify-between px-6 border-b border-watt-border bg-watt-bg">
                        <span class="font-bold text-white text-base">ADMIN MENU</span>
                        <button id="mobile-close" class="p-2 rounded-lg hover:bg-watt-hover text-watt-text-sec hover:text-white">
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <nav class="flex-grow px-4 py-6 space-y-2 overflow-y-auto">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                            <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                            Dashboard
                        </a>
                        <a href="{{ route('admin.games.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.games.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                            <i data-lucide="gamepad-2" class="w-4 h-4"></i>
                            Manajemen Game
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.products.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                            <i data-lucide="package" class="w-4 h-4"></i>
                            Manajemen Produk
                        </a>
                        <a href="{{ route('admin.banners.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.banners.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                            <i data-lucide="image" class="w-4 h-4"></i>
                            Manajemen Banner
                        </a>
                        <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.testimonials.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                            <i data-lucide="message-square" class="w-4 h-4"></i>
                            Ulasan / Testimoni
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.settings.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                            <i data-lucide="settings" class="w-4 h-4"></i>
                            Pengaturan Toko
                        </a>
                    </nav>
                    <div class="p-4 border-t border-watt-border space-y-2">
                        <a href="{{ route('home') }}" class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl text-xs font-semibold bg-watt-hover text-watt-text-sec hover:bg-[#333] hover:text-white">
                            <i data-lucide="external-link" class="w-4 h-4"></i>
                            Lihat Website
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-xs font-semibold bg-watt-alert-bg text-watt-red hover:bg-[#4A2C2C] hover:text-white text-left cursor-pointer">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toggle scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();

            const mobileToggle = document.getElementById('mobile-toggle');
            const mobileSidebar = document.getElementById('mobile-sidebar');
            const mobileClose = document.getElementById('mobile-close');
            const mobileOverlay = document.getElementById('mobile-overlay');

            function toggleSidebar() {
                mobileSidebar.classList.toggle('hidden');
            }

            if (mobileToggle) mobileToggle.addEventListener('click', toggleSidebar);
            if (mobileClose) mobileClose.addEventListener('click', toggleSidebar);
            if (mobileOverlay) mobileOverlay.addEventListener('click', toggleSidebar);
        });
    </script>
</body>
</html>
