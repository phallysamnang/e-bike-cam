<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>VOLT Console Control</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Kantumruy+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            brand: '#00ff66',
                            darkbg: '#0f1115',
                        },
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                            khmer: ['Kantumruy Pro', 'sans-serif'],
                        }
                    }
                }
            }
        </script>
        <style>
            :root {
                --bg-body: #0f1115;
                --bg-card: #161920;
                --bg-elevated: #13161c;
                --bg-glass: rgba(255, 255, 255, 0.02);
                --bg-glass-hover: rgba(255, 255, 255, 0.05);
                --bg-glass-strong: rgba(255, 255, 255, 0.1);
                --text-primary: #fff;
                --text-secondary: #9ca3af;
                --text-muted: #6b7280;
                --text-gray-300: #d1d5db;
                --border: rgba(255, 255, 255, 0.05);
                --border-strong: rgba(255, 255, 255, 0.1);
                --scrollbar-track: #0f1115;
                --scrollbar-thumb: #1f2937;
                --nav-bg: #12141c;
                --sidebar-bg: rgba(255, 255, 255, 0.02);
            }
            [data-theme="light"] {
                --bg-body: #f8fafc;
                --bg-card: #ffffff;
                --bg-elevated: #f1f5f9;
                --bg-glass: rgba(0, 0, 0, 0.02);
                --bg-glass-hover: rgba(0, 0, 0, 0.05);
                --bg-glass-strong: rgba(0, 0, 0, 0.1);
                --text-primary: #0f172a;
                --text-secondary: #64748b;
                --text-muted: #94a3b8;
                --text-gray-300: #475569;
                --border: rgba(0, 0, 0, 0.06);
                --border-strong: rgba(0, 0, 0, 0.1);
                --scrollbar-track: #f1f5f9;
                --scrollbar-thumb: #cbd5e1;
                --nav-bg: #ffffff;
                --sidebar-bg: rgba(0, 0, 0, 0.02);
            }
            body { background-color: var(--bg-body); color: var(--text-primary); font-family: 'Figtree', sans-serif; }
            ::-webkit-scrollbar { width: 6px; }
            ::-webkit-scrollbar-track { background: var(--scrollbar-track); }
            ::-webkit-scrollbar-thumb { background: var(--scrollbar-thumb); border-radius: 4px; }
            [data-theme="light"] .text-white { color: var(--text-primary); }
            [data-theme="light"] .text-gray-400 { color: var(--text-secondary); }
            [data-theme="light"] .text-gray-500 { color: var(--text-muted); }
            [data-theme="light"] .border-white\/5 { border-color: var(--border); }
            [data-theme="light"] .bg-white\/5 { background-color: var(--bg-glass-hover); }
            [data-theme="light"] .bg-white\/\[0\.02\] { background-color: var(--sidebar-bg); }
        </style>
        @vite(['resources/css/app.css'])
    </head>
    <body class="antialiased min-h-screen {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">

        <nav class="bg-[var(--nav-bg)] border-b border-[var(--border)] fixed top-0 w-full z-50 h-20 flex items-center">
            <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="text-xl font-black tracking-wider" style="color: var(--text-primary);">VOLT<span class="text-brand">.</span></a>
                    <span class="px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-widest bg-brand/10 text-brand border border-brand/20">Console Dashboard</span>
                </div>
                <div class="flex items-center gap-2 sm:gap-3">
                    <a href="{{ route('language.switch', app()->getLocale() === 'km' ? 'en' : 'km') }}" class="text-[10px] font-black uppercase tracking-widest px-2.5 py-1.5 rounded-full border {{ app()->getLocale() === 'km' ? 'bg-brand/10 text-brand border-brand/20' : 'bg-white/5 text-gray-400 border-white/10' }} hover:bg-brand hover:text-darkbg hover:border-brand transition-all">
                        {{ app()->getLocale() === 'km' ? 'EN' : 'KH' }}
                    </a>
                    <button onclick="toggleTheme()" class="p-2 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-all group" title="Toggle theme">
                        <svg id="moon-icon-admin" class="w-4 h-4 text-gray-400 group-hover:text-brand transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <svg id="sun-icon-admin" class="w-4 h-4 text-gray-400 group-hover:text-brand transition-colors hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </button>
                    <span class="text-xs font-bold" style="color: var(--text-secondary); background-color: var(--bg-glass-hover); padding: 0.375rem 0.75rem; border-radius: 0.75rem; border: 1px solid var(--border);">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs font-bold text-red-400 hover:text-red-300 uppercase tracking-wider transition-colors">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12 flex flex-col lg:flex-row gap-8 min-h-screen">

            <aside class="w-full lg:w-64 flex-shrink-0">
                <div class="bg-[var(--sidebar-bg)] border border-[var(--border)] rounded-[2rem] p-6 space-y-4 sticky top-28 backdrop-blur-xl">
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-500 block px-2">{{ __('Console Operations') }}</span>
                    <nav class="space-y-1">
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-brand text-darkbg font-black' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl text-xs uppercase tracking-wider font-bold shadow-lg transition-colors">
                            {{ __('Dashboard') }}
                        </a>
                        @can('view-products')
                            <a href="{{ route('products.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('products.*') ? 'bg-brand text-darkbg font-black' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl text-xs uppercase tracking-wider font-bold transition-colors">
                                {{ __('Products') }}
                            </a>
                        @endcan
                        @can('view-categories')
                            <a href="{{ route('categories.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('categories.*') ? 'bg-brand text-darkbg font-black' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl text-xs uppercase tracking-wider font-bold transition-colors">
                                {{ __('Categories') }}
                            </a>
                        @endcan
                        @can('view-slides')
                            <a href="{{ route('slides.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('slides.*') ? 'bg-brand text-darkbg font-black' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl text-xs uppercase tracking-wider font-bold transition-colors">
                                {{ __('Slides') }}
                            </a>
                        @endcan
                        @can('view-orders')
                            <a href="{{ route('admin.orders.index') }}" class="flex items-center justify-between px-4 py-3 {{ request()->routeIs('admin.orders.*') ? 'bg-brand text-darkbg font-black' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl text-xs uppercase tracking-wider font-bold transition-colors">
                                <span>{{ __('Orders') }}</span>
                                @if($pendingPaymentsCount > 0)
                                    <span class="inline-flex items-center justify-center w-5 h-5 text-[9px] font-black rounded-full bg-red-500 text-white">{{ $pendingPaymentsCount }}</span>
                                @endif
                            </a>
                        @endcan
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.reports.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.reports.*') ? 'bg-brand text-darkbg font-black' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl text-xs uppercase tracking-wider font-bold transition-colors">
                                {{ __('Reports') }}
                            </a>
                        @endif
                        <a href="{{ route('admin.chat.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.chat.*') ? 'bg-brand text-darkbg font-black' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl text-xs uppercase tracking-wider font-bold transition-colors">
                            {{ __('Chat') }}
                        </a>
                        @if(auth()->user()->isAdmin())
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-600 block px-2 pt-3">{{ __('Administration') }}</span>
                            <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.users.*') ? 'bg-brand text-darkbg font-black' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl text-xs uppercase tracking-wider font-bold transition-colors">
                                {{ __('Users') }}
                            </a>
                            <a href="{{ route('admin.roles.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.roles.*') ? 'bg-brand text-darkbg font-black' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl text-xs uppercase tracking-wider font-bold transition-colors">
                                {{ __('Roles') }}
                            </a>
                            <a href="{{ route('admin.permissions.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.permissions.*') ? 'bg-brand text-darkbg font-black' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl text-xs uppercase tracking-wider font-bold transition-colors">
                                {{ __('Permissions') }}
                            </a>
                        @endif
                        <a href="{{ url('/') }}" target="_blank" class="flex items-center px-4 py-3 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl text-xs uppercase tracking-wider font-bold transition-colors">
                            {{ __('View Site') }}
                        </a>
                    </nav>
                </div>
            </aside>

            <main class="flex-grow space-y-6 min-w-0">
                @if(session('success'))
                    <div class="bg-brand/10 border border-brand/20 text-brand font-semibold px-6 py-4 rounded-2xl text-sm flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-500/10 border border-red-500/20 text-red-400 font-semibold px-6 py-4 rounded-2xl text-sm flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        {{ session('error') }}
                    </div>
                @endif
                {{ $slot }}
            </main>

        </div>

    <script>
        (function() {
            const saved = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', saved);
            document.addEventListener('DOMContentLoaded', function() {
                const moon = document.getElementById('moon-icon-admin');
                const sun = document.getElementById('sun-icon-admin');
                if (moon) moon.classList.toggle('hidden', saved === 'dark');
                if (sun) sun.classList.toggle('hidden', saved === 'light');
            });
        })();
        function toggleTheme() {
            const current = document.documentElement.getAttribute('data-theme');
            const next = current === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);
            document.getElementById('moon-icon-admin')?.classList.toggle('hidden', next === 'dark');
            document.getElementById('sun-icon-admin')?.classList.toggle('hidden', next === 'light');
        }
    </script>
    </body>
</html>
