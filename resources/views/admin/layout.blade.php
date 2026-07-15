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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 min-h-screen flex flex-col">
    <!-- Main Outer Wrapper -->
    <div class="flex flex-1 overflow-hidden">
        
        <!-- Sidebar (Desktop) -->
        <aside class="hidden lg:flex flex-col w-64 bg-slate-900 text-slate-300 border-r border-slate-800/80">
            <!-- Sidebar Header -->
            <div class="h-16 flex items-center px-6 border-b border-slate-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-violet-600 flex items-center justify-center text-white font-bold">
                        <i data-lucide="shield" class="w-4 h-4"></i>
                    </div>
                    <span class="font-bold text-white text-base">ADMIN PANEL</span>
                </a>
            </div>

            <!-- Sidebar Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-violet-600 text-white' : '' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    Dashboard
                </a>

                <a href="{{ route('admin.games.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ request()->routeIs('admin.games.*') ? 'bg-violet-600 text-white' : '' }}">
                    <i data-lucide="gamepad-2" class="w-4 h-4"></i>
                    Manajemen Game
                </a>

                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ request()->routeIs('admin.products.*') ? 'bg-violet-600 text-white' : '' }}">
                    <i data-lucide="package" class="w-4 h-4"></i>
                    Manajemen Produk
                </a>

                <a href="{{ route('admin.banners.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ request()->routeIs('admin.banners.*') ? 'bg-violet-600 text-white' : '' }}">
                    <i data-lucide="image" class="w-4 h-4"></i>
                    Manajemen Banner
                </a>

                <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ request()->routeIs('admin.testimonials.*') ? 'bg-violet-600 text-white' : '' }}">
                    <i data-lucide="message-square" class="w-4 h-4"></i>
                    Ulasan / Testimoni
                </a>

                <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ request()->routeIs('admin.settings') ? 'bg-violet-600 text-white' : '' }}">
                    <i data-lucide="settings" class="w-4 h-4"></i>
                    Pengaturan Toko
                </a>
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-slate-800 space-y-2">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg text-xs font-semibold bg-slate-800 text-slate-300 hover:bg-slate-700 hover:text-white transition-all">
                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                    Lihat Website
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-xs font-semibold bg-red-950/20 text-red-400 hover:bg-red-900/40 hover:text-white transition-all text-left cursor-pointer">
                        <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Top Navbar (Mobile toggle & Header title) -->
            <header class="h-16 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-6 z-20">
                <div class="flex items-center gap-4">
                    <!-- Mobile Sidebar Toggle -->
                    <button id="mobile-toggle" class="lg:hidden p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-slate-100">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>
                    <h2 class="text-base sm:text-lg font-bold text-slate-800 dark:text-white">@yield('page_title', 'Admin Panel')</h2>
                </div>

                <!-- Admin user badge -->
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex flex-col text-right">
                        <span class="text-xs font-bold text-slate-800 dark:text-white">{{ Auth::user()->name }}</span>
                        <span class="text-[10px] text-slate-400">Administrator</span>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-violet-600 flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Page Main Content Body -->
            <main class="flex-1 overflow-y-auto p-6 bg-slate-50 dark:bg-slate-950">
                <!-- Success Alert -->
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-200 dark:border-emerald-900/30 text-emerald-600 dark:text-emerald-400 text-xs font-semibold flex items-center gap-2">
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
            <div id="mobile-overlay" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
            <!-- Menu container -->
            <div class="absolute inset-y-0 left-0 max-w-full flex">
                <div class="w-64 bg-slate-900 text-slate-300 flex flex-col h-full">
                    <div class="h-16 flex items-center justify-between px-6 border-b border-slate-800 bg-slate-950">
                        <span class="font-bold text-white text-base">ADMIN MENU</span>
                        <button id="mobile-close" class="p-2 rounded-lg hover:bg-slate-800 text-slate-400 hover:text-white">
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <nav class="flex-grow px-4 py-6 space-y-1.5 overflow-y-auto">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-violet-600 text-white' : '' }}">
                            <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                            Dashboard
                        </a>
                        <a href="{{ route('admin.games.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ request()->routeIs('admin.games.*') ? 'bg-violet-600 text-white' : '' }}">
                            <i data-lucide="gamepad-2" class="w-4 h-4"></i>
                            Manajemen Game
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ request()->routeIs('admin.products.*') ? 'bg-violet-600 text-white' : '' }}">
                            <i data-lucide="package" class="w-4 h-4"></i>
                            Manajemen Produk
                        </a>
                        <a href="{{ route('admin.banners.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ request()->routeIs('admin.banners.*') ? 'bg-violet-600 text-white' : '' }}">
                            <i data-lucide="image" class="w-4 h-4"></i>
                            Manajemen Banner
                        </a>
                        <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ request()->routeIs('admin.testimonials.*') ? 'bg-violet-600 text-white' : '' }}">
                            <i data-lucide="message-square" class="w-4 h-4"></i>
                            Ulasan / Testimoni
                        </a>
                        <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ request()->routeIs('admin.settings') ? 'bg-violet-600 text-white' : '' }}">
                            <i data-lucide="settings" class="w-4 h-4"></i>
                            Pengaturan Toko
                        </a>
                    </nav>
                    <div class="p-4 border-t border-slate-800 space-y-2">
                        <a href="{{ route('home') }}" class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl text-xs font-semibold bg-slate-800 text-slate-300 hover:bg-slate-700 hover:text-white">
                            <i data-lucide="external-link" class="w-4 h-4"></i>
                            Lihat Website
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-xs font-semibold bg-red-950/20 text-red-400 hover:bg-red-900/40 hover:text-white text-left cursor-pointer">
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
