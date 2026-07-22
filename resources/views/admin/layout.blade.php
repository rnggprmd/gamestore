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

    <!-- Favicon -->
    @php
        $adminSetting = \App\Models\Setting::first();
    @endphp
    @if(isset($adminSetting) && $adminSetting->favicon && file_exists(public_path('img/' . $adminSetting->favicon)))
        <link rel="icon" type="image/png" href="{{ asset('img/' . $adminSetting->favicon) }}">
    @elseif(isset($adminSetting) && $adminSetting->logo && file_exists(public_path('img/' . $adminSetting->logo)))
        <link rel="icon" type="image/png" href="{{ asset('img/' . $adminSetting->logo) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('img/logo gamestore.png') }}">
    @endif

    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Scrollbar Styling -->
    <style>
        /* Prevent layout shift - reserve scrollbar space */
        html {
            scrollbar-gutter: stable;
        }

        body {
            overflow-y: hidden;
        }

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

        /* Toast Notification Animations */
        @keyframes slideInToast {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes slideOutToast {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
        .toast-slide-in {
            animation: slideInToast 0.3s ease-out;
        }
        .toast-slide-out {
            animation: slideOutToast 0.3s ease-in;
        }

        /* Mobile Sidebar Animation */
        @keyframes sidebarSlideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes sidebarSlideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(-100%);
                opacity: 0;
            }
        }

        @keyframes overlayFadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes overlayFadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }

        .sidebar-slide-in {
            animation: sidebarSlideIn 0.3s ease-out forwards;
        }

        .sidebar-slide-out {
            animation: sidebarSlideOut 0.3s ease-in forwards;
        }

        .overlay-fade-in {
            animation: overlayFadeIn 0.3s ease-out forwards;
        }

        .overlay-fade-out {
            animation: overlayFadeOut 0.3s ease-in forwards;
        }

        /* Sidebar Collapse Animation */
        @keyframes collapseIn {
            from {
                width: 256px;
            }
            to {
                width: 80px;
            }
        }

        @keyframes expandOut {
            from {
                width: 80px;
            }
            to {
                width: 256px;
            }
        }

        /* Outer container untuk mencegah scroll saat resize */
        #desktop-sidebar {
            transition: width 0.3s ease !important;
            will-change: width;
            flex-shrink: 0;
        }

        .sidebar-collapsed {
            width: 80px !important;
        }

        .sidebar-expanded {
            width: 256px !important;
        }

        /* Pastikan main content area tidak shift */
        main {
            min-width: 0;
            scrollbar-gutter: stable;
        }

        .sidebar-text {
            transition: opacity 0.3s ease;
        }

        .sidebar-collapsed .sidebar-text {
            opacity: 0;
            display: none;
        }

        .sidebar-icon-only {
            justify-content: center;
        }

        .collapse-btn {
            transition: all 0.3s ease;
        }

        .collapse-btn:hover {
            background-color: rgba(0, 229, 255, 0.1);
            color: #00E5FF;
        }

        /* Staggered Menu Items Animation */
        @keyframes menuItemSlideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .menu-item-animated {
            animation: menuItemSlideIn 0.3s ease-out forwards;
            opacity: 0;
        }

        .menu-item-animated:nth-child(1) { animation-delay: 0.05s; }
        .menu-item-animated:nth-child(2) { animation-delay: 0.1s; }
        .menu-item-animated:nth-child(3) { animation-delay: 0.15s; }
        .menu-item-animated:nth-child(4) { animation-delay: 0.2s; }
        .menu-item-animated:nth-child(5) { animation-delay: 0.25s; }
        .menu-item-animated:nth-child(6) { animation-delay: 0.3s; }

        /* Logo Animation */
        @keyframes logoFadeScale {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .logo-animated {
            animation: logoFadeScale 0.4s ease-out forwards;
            opacity: 0;
        }

        /* Menu Item Hover Animation */
        .menu-item-hover {
            position: relative;
            overflow: hidden;
        }

        .menu-item-hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 229, 255, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .menu-item-hover:hover::before {
            left: 100%;
        }

        /* Smooth transition for active state */
        .menu-item-active-animation {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Sidebar footer items animation */
        @keyframes footerItemFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .footer-item-animated {
            animation: footerItemFadeIn 0.3s ease-out forwards;
            opacity: 0;
        }

        .footer-item-animated:nth-child(1) { animation-delay: 0.35s; }
        .footer-item-animated:nth-child(2) { animation-delay: 0.4s; }
    </style>

    <!-- Global Toast Notification System -->
    <style>
        @keyframes toast-slide-in {
            from {
                opacity: 0;
                transform: translateX(100%) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }
        
        @keyframes toast-slide-out {
            from {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
            to {
                opacity: 0;
                transform: translateX(100%) scale(0.95);
            }
        }
        
        .toast-slide-in {
            animation: toast-slide-in 0.3s ease-out forwards;
        }
        
        .toast-slide-out {
            animation: toast-slide-out 0.3s ease-in forwards;
        }
        
        /* Ensure modal appears immediately with CSS for error states */
        .modal-error-state {
            display: flex !important;
        }
    </style>

    <script>
        function showToast(message, type = 'success', duration = 5000) {
            // Jika sudah ada toast, hapus dulu
            const existingToast = document.getElementById('global-toast');
            if (existingToast) {
                existingToast.remove();
            }

            // Buat container toast
            const toastContainer = document.createElement('div');
            toastContainer.id = 'global-toast';
            toastContainer.className = 'fixed top-6 right-6 z-[99999] max-w-md toast-slide-in';
            
            // Tentukan warna berdasarkan type
            let bgColor = '#1A2C22';
            let borderColor = 'border-watt-green';
            let textColor = 'text-watt-green';
            let icon = 'check-circle-2';
            
            if (type === 'error') {
                bgColor = '#2C1A1A';
                borderColor = 'border-watt-red';
                textColor = 'text-watt-red';
                icon = 'alert-circle';
            } else if (type === 'warning') {
                bgColor = '#2C2618';
                borderColor = 'border-yellow-500';
                textColor = 'text-yellow-400';
                icon = 'alert-triangle';
            } else if (type === 'info') {
                bgColor = '#1A242C';
                borderColor = 'border-blue-500';
                textColor = 'text-blue-400';
                icon = 'info';
            }
            
            toastContainer.innerHTML = `
                <div class="p-4 rounded-[16px] border-l-4 ${borderColor} ${textColor} text-xs font-semibold flex items-center gap-2 shadow-xl" style="background-color: ${bgColor}">
                    <i data-lucide="${icon}" class="w-4 h-4 flex-shrink-0"></i>
                    <span>${message}</span>
                    <button type="button" onclick="document.getElementById('global-toast')?.remove()" class="ml-4 p-1 hover:opacity-70 transition-opacity cursor-pointer">
                        <i data-lucide="x" class="w-3.5 h-3.5"></i>
                    </button>
                </div>
            `;
            
            document.body.appendChild(toastContainer);
            
            // Re-render lucide icons
            if (window.lucide) {
                lucide.createIcons();
            }
            
            // Auto-remove after duration
            if (duration > 0) {
                setTimeout(() => {
                    if (toastContainer && toastContainer.parentElement) {
                        toastContainer.classList.add('toast-slide-out');
                        setTimeout(() => toastContainer.remove(), 300);
                    }
                }, duration);
            }
        }

        // Export untuk penggunaan global
        window.showToast = showToast;
    </script>
</head>
<body class="bg-watt-bg text-white h-screen overflow-hidden flex flex-col" style="overflow-y: hidden !important;">
    <!-- Main Outer Wrapper -->
    <div class="flex flex-1 overflow-hidden" style="gap: 0; padding: 0;">
        
        <!-- Sidebar (Desktop) -->
        <aside id="desktop-sidebar" class="hidden lg:flex flex-col bg-watt-surface text-watt-text-sec border-r border-watt-border sidebar-expanded transition-all duration-300">
            <!-- Sidebar Header -->
            <div class="h-28 flex items-center justify-center px-6 pt-4 bg-watt-bg border-b border-watt-border relative">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 logo-animated">
                    @if(isset($adminSetting) && $adminSetting->logo && file_exists(public_path('img/' . $adminSetting->logo)))
                        <img src="{{ asset('img/' . $adminSetting->logo) }}" alt="Gamestore Logo" class="h-20 w-auto sidebar-text object-contain">
                    @else
                        <img src="{{ asset('img/logo gamestore.png') }}" alt="Gamestore Logo" class="h-20 w-auto sidebar-text object-contain">
                    @endif
                </a>
                <button id="sidebar-collapse-btn" onclick="toggleSidebarCollapse()" class="absolute right-6 p-2 rounded-lg collapse-btn flex-shrink-0 text-watt-text-sec hover:text-watt-cyan">
                    <i id="collapse-icon" data-lucide="chevron-left" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Sidebar Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 hover:translate-x-1 menu-item-hover menu-item-active-animation menu-item-animated {{ request()->routeIs('admin.dashboard') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}" title="Dashboard">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 flex-shrink-0"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>

                <a href="{{ route('admin.games.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 hover:translate-x-1 menu-item-hover menu-item-active-animation menu-item-animated {{ request()->routeIs('admin.games.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}" title="Manajemen Game">
                    <i data-lucide="gamepad-2" class="w-4 h-4 flex-shrink-0"></i>
                    <span class="sidebar-text">Manajemen Game</span>
                </a>

                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 hover:translate-x-1 menu-item-hover menu-item-active-animation menu-item-animated {{ request()->routeIs('admin.products.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}" title="Manajemen Produk">
                    <i data-lucide="package" class="w-4 h-4 flex-shrink-0"></i>
                    <span class="sidebar-text">Manajemen Produk</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 hover:translate-x-1 menu-item-hover menu-item-active-animation menu-item-animated {{ request()->routeIs('admin.categories.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}" title="Kategori Produk">
                    <i data-lucide="folder" class="w-4 h-4 flex-shrink-0"></i>
                    <span class="sidebar-text">Kategori Produk</span>
                </a>

                <a href="{{ route('admin.banners.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 hover:translate-x-1 menu-item-hover menu-item-active-animation menu-item-animated {{ request()->routeIs('admin.banners.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}" title="Manajemen Banner">
                    <i data-lucide="image" class="w-4 h-4 flex-shrink-0"></i>
                    <span class="sidebar-text">Manajemen Banner</span>
                </a>

                <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 hover:translate-x-1 menu-item-hover menu-item-active-animation menu-item-animated {{ request()->routeIs('admin.testimonials.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}" title="Ulasan / Testimoni">
                    <i data-lucide="message-square" class="w-4 h-4 flex-shrink-0"></i>
                    <span class="sidebar-text">Ulasan / Testimoni</span>
                </a>

                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 hover:translate-x-1 menu-item-hover menu-item-active-animation menu-item-animated {{ request()->routeIs('admin.settings.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}" title="Pengaturan Toko">
                    <i data-lucide="settings" class="w-4 h-4 flex-shrink-0"></i>
                    <span class="sidebar-text">Pengaturan Toko</span>
                </a>
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-watt-border space-y-2">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg text-xs font-semibold bg-watt-hover text-watt-text-sec hover:bg-[#333] hover:text-white transition-all footer-item-animated" title="Lihat Website">
                    <i data-lucide="external-link" class="w-3.5 h-3.5 flex-shrink-0"></i>
                    <span class="sidebar-text">Lihat Website</span>
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-xs font-semibold bg-watt-alert-bg text-watt-red hover:bg-[#4A2C2C] hover:text-white transition-all text-left cursor-pointer footer-item-animated" title="Logout">
                        <i data-lucide="log-out" class="w-3.5 h-3.5 flex-shrink-0"></i>
                        <span class="sidebar-text">Logout</span>
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
            <div id="mobile-menu-panel" class="absolute inset-y-0 left-0 max-w-full flex">
                <div class="w-64 bg-watt-surface text-watt-text-sec flex flex-col h-full">
                    <div class="h-28 flex items-center justify-center px-6 border-b border-watt-border bg-watt-bg relative">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center logo-animated">
                            @if(isset($adminSetting) && $adminSetting->logo && file_exists(public_path('img/' . $adminSetting->logo)))
                                <img src="{{ asset('img/' . $adminSetting->logo) }}" alt="Gamestore Logo" class="h-20 w-auto object-contain">
                            @else
                                <img src="{{ asset('img/logo gamestore.png') }}" alt="Gamestore Logo" class="h-20 w-auto object-contain">
                            @endif
                        </a>
                        <button id="mobile-close" class="absolute right-6 p-2 rounded-lg hover:bg-watt-hover text-watt-text-sec hover:text-white">
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <nav class="flex-grow px-4 py-6 space-y-2 overflow-y-auto">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 menu-item-hover menu-item-active-animation menu-item-animated {{ request()->routeIs('admin.dashboard') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                            <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                            Dashboard
                        </a>
                        <a href="{{ route('admin.games.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 menu-item-hover menu-item-active-animation menu-item-animated {{ request()->routeIs('admin.games.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                            <i data-lucide="gamepad-2" class="w-4 h-4"></i>
                            Manajemen Game
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 menu-item-hover menu-item-active-animation menu-item-animated {{ request()->routeIs('admin.products.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                            <i data-lucide="package" class="w-4 h-4"></i>
                            Manajemen Produk
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 menu-item-hover menu-item-active-animation menu-item-animated {{ request()->routeIs('admin.categories.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                            <i data-lucide="folder" class="w-4 h-4"></i>
                            Kategori Produk
                        </a>
                        <a href="{{ route('admin.banners.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 menu-item-hover menu-item-active-animation menu-item-animated {{ request()->routeIs('admin.banners.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                            <i data-lucide="image" class="w-4 h-4"></i>
                            Manajemen Banner
                        </a>
                        <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 menu-item-hover menu-item-active-animation menu-item-animated {{ request()->routeIs('admin.testimonials.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                            <i data-lucide="message-square" class="w-4 h-4"></i>
                            Ulasan / Testimoni
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 menu-item-hover menu-item-active-animation menu-item-animated {{ request()->routeIs('admin.settings.*') ? 'bg-watt-cyan text-watt-bg shadow-[0_4px_20px_rgba(0,229,255,0.25)] font-semibold' : 'text-watt-text-sec hover:bg-watt-hover/60 hover:text-white' }}">
                            <i data-lucide="settings" class="w-4 h-4"></i>
                            Pengaturan Toko
                        </a>
                    </nav>
                    <div class="p-4 border-t border-watt-border space-y-2">
                        <a href="{{ route('home') }}" class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl text-xs font-semibold bg-watt-hover text-watt-text-sec hover:bg-[#333] hover:text-white footer-item-animated">
                            <i data-lucide="external-link" class="w-4 h-4"></i>
                            Lihat Website
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-xs font-semibold bg-watt-alert-bg text-watt-red hover:bg-[#4A2C2C] hover:text-white text-left cursor-pointer footer-item-animated">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Alert Toast (Portal - Always on top) -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session("success") }}', 'success', 5000);
            });
        </script>
    @endif

    <!-- Toggle scripts -->
    <script>
        let sidebarCollapsed = false;

        function toggleSidebarCollapse() {
            const sidebar = document.getElementById('desktop-sidebar');
            const collapseIcon = document.getElementById('collapse-icon');
            
            sidebarCollapsed = !sidebarCollapsed;
            
            if (sidebarCollapsed) {
                sidebar.classList.remove('sidebar-expanded');
                sidebar.classList.add('sidebar-collapsed');
                // Change icon direction
                collapseIcon.setAttribute('data-lucide', 'chevron-right');
            } else {
                sidebar.classList.remove('sidebar-collapsed');
                sidebar.classList.add('sidebar-expanded');
                // Change icon direction
                collapseIcon.setAttribute('data-lucide', 'chevron-left');
            }
            
            // Re-render lucide icons
            if (window.lucide) {
                lucide.createIcons();
            }
            
            // Save collapse state to localStorage
            localStorage.setItem('sidebarCollapsed', sidebarCollapsed);
        }

        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();

            // Restore sidebar state from localStorage
            const savedState = localStorage.getItem('sidebarCollapsed');
            if (savedState === 'true') {
                sidebarCollapsed = true;
                const sidebar = document.getElementById('desktop-sidebar');
                sidebar.classList.remove('sidebar-expanded');
                sidebar.classList.add('sidebar-collapsed');
                
                const collapseIcon = document.getElementById('collapse-icon');
                collapseIcon.setAttribute('data-lucide', 'chevron-right');
                
                if (window.lucide) {
                    lucide.createIcons();
                }
            }

            const mobileToggle = document.getElementById('mobile-toggle');
            const mobileSidebar = document.getElementById('mobile-sidebar');
            const mobileMenuPanel = document.getElementById('mobile-menu-panel');
            const mobileOverlay = document.getElementById('mobile-overlay');
            const mobileClose = document.getElementById('mobile-close');

            function openSidebar() {
                mobileSidebar.classList.remove('hidden');
                // Trigger animation on next frame to ensure CSS transitions work
                requestAnimationFrame(() => {
                    mobileMenuPanel.classList.add('sidebar-slide-in');
                    mobileMenuPanel.classList.remove('sidebar-slide-out');
                    mobileOverlay.classList.add('overlay-fade-in');
                    mobileOverlay.classList.remove('overlay-fade-out');
                });
            }

            function closeSidebar() {
                mobileMenuPanel.classList.remove('sidebar-slide-in');
                mobileMenuPanel.classList.add('sidebar-slide-out');
                mobileOverlay.classList.remove('overlay-fade-in');
                mobileOverlay.classList.add('overlay-fade-out');
                
                // Hide after animation completes
                setTimeout(() => {
                    if (mobileSidebar.classList.contains('hidden') === false) {
                        mobileSidebar.classList.add('hidden');
                    }
                }, 300);
            }

            function toggleSidebar() {
                if (mobileSidebar.classList.contains('hidden')) {
                    openSidebar();
                } else {
                    closeSidebar();
                }
            }

            if (mobileToggle) mobileToggle.addEventListener('click', toggleSidebar);
            if (mobileClose) mobileClose.addEventListener('click', closeSidebar);
            if (mobileOverlay) mobileOverlay.addEventListener('click', closeSidebar);
        });
    </script>
</body>
</html>
