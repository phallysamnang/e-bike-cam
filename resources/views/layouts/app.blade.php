<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOLT | Premium Electric Bicycles</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Kantumruy+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#00ff66', // Electric Green
                        darkbg: '#0f1115', // Deep Slate
                        glass: 'rgba(255, 255, 255, 0.03)',
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
            --border: rgba(255, 255, 255, 0.05);
            --border-strong: rgba(255, 255, 255, 0.1);
            --footer-bg: #0b0c10;
            --scrollbar-track: #0f1115;
            --scrollbar-thumb: #1f2937;
            --scrollbar-thumb-hover: #374151;
            --placeholder-bg: #1e222b;
            --badge-bg: rgba(15, 17, 21, 0.8);
            --tw-bg-opacity: 1;
            --tw-text-opacity: 1;
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
            --border: rgba(0, 0, 0, 0.06);
            --border-strong: rgba(0, 0, 0, 0.1);
            --footer-bg: #ffffff;
            --scrollbar-track: #f1f5f9;
            --scrollbar-thumb: #cbd5e1;
            --scrollbar-thumb-hover: #94a3b8;
            --placeholder-bg: #e2e8f0;
            --badge-bg: rgba(248, 250, 252, 0.8);
        }

        body { background-color: var(--bg-body); color: var(--text-primary); }
        .glass-card {
            background: var(--bg-glass);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border);
        }

        [data-theme="light"] .text-white { color: var(--text-primary); }
        [data-theme="light"] .text-gray-300 { color: #334155; }
        [data-theme="light"] .text-gray-400 { color: var(--text-secondary); }
        [data-theme="light"] .text-gray-500 { color: var(--text-muted); }
        [data-theme="light"] .border-white\/5 { border-color: var(--border); }
        [data-theme="light"] .border-white\/10 { border-color: var(--border-strong); }
        [data-theme="light"] .border-white\/20 { border-color: rgba(0, 0, 0, 0.15); }
        [data-theme="light"] .bg-white\/5 { background-color: var(--bg-glass-hover); }
        [data-theme="light"] .bg-white\/10 { background-color: var(--bg-glass-strong); }
        [data-theme="light"] .bg-\[rgba\(255\2c 255\2c 255\2c 0\.02\)\] { background-color: var(--bg-glass); }
        [data-theme="light"] .bg-\[\#0f1115\] { background-color: var(--bg-body); }
        [data-theme="light"] .bg-\[\#0f1115\]\/80 { background-color: var(--badge-bg); }
        [data-theme="light"] .bg-\[\#161920\] { background-color: var(--bg-card); }
        [data-theme="light"] .bg-\[\#13161c\] { background-color: var(--bg-elevated); }
        [data-theme="light"] .bg-\[\#0b0c10\] { background-color: var(--footer-bg); }
        [data-theme="light"] .bg-\[\#1e222b\] { background-color: var(--placeholder-bg); }
        [data-theme="light"] .border-\[\#0f1115\] { border-color: var(--bg-body); }
        [data-theme="light"] footer .border-white\/5 { border-color: var(--border); }
        [data-theme="light"] .content { color: var(--text-primary); }
        
        .slider-wrapper {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .slides {
            display: flex;
            width: 100%;
            height: 100%;
            transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .slide {
            min-width: 100%;
            height: 100%;
            position: relative;
            flex-shrink: 0;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scale(1.05);
            transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .slides[style*="transform"] .slide img {
            transform: scale(1);
        }

        .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(15, 17, 21, 0.95) 5%, rgba(15, 17, 21, 0.4) 50%, rgba(15, 17, 21, 0.2) 100%);
        }
        [data-theme="light"] .overlay {
            background: linear-gradient(to top, rgba(248, 250, 252, 0.95) 5%, rgba(248, 250, 252, 0.4) 50%, rgba(248, 250, 252, 0.2) 100%);
        }

        .content {
            position: absolute;
            bottom: 140px;
            left: 10%;
            color: white;
            max-width: 700px;
            z-index: 10;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--scrollbar-track);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--scrollbar-thumb);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--scrollbar-thumb-hover);
        }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col justify-between {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">

    <nav class="fixed top-4 left-1/2 -translate-x-1/2 w-[90%] max-w-7xl glass-card rounded-full px-6 py-3 flex justify-between items-center z-50 shadow-2xl">
        <a href="#" class="text-2xl font-extrabold tracking-wider text-white">VOLT<span class="text-brand">.</span></a>
        
        <div class="hidden md:flex space-x-8 text-sm font-medium tracking-wide text-gray-400">
            <a href="/" class="hover:text-brand transition-colors">{{ __('Home') }}</a>
            <a href="#categories" class="hover:text-brand transition-colors">{{ __('Categories') }}</a>
            <a href="#bikes" class="hover:text-brand transition-colors">{{ __('E-Bikes') }}</a>
            <a href="#" class="hover:text-brand transition-colors">{{ __('Technology') }}</a>
        </div>

        <div class="flex items-center space-x-2 sm:space-x-3">
            <button onclick="toggleTheme()" class="relative p-2.5 rounded-full bg-white/5 border border-white/10 hover:bg-white/10 transition-all group" title="Toggle theme">
                <svg id="moon-icon" class="w-4 h-4 text-gray-400 group-hover:text-brand transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                <svg id="sun-icon" class="w-4 h-4 text-gray-400 group-hover:text-brand transition-colors hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </button>
            <a href="{{ route('language.switch', app()->getLocale() === 'km' ? 'en' : 'km') }}" class="text-[10px] font-black uppercase tracking-widest px-2.5 py-1.5 rounded-full border {{ app()->getLocale() === 'km' ? 'bg-brand/10 text-brand border-brand/20' : 'bg-white/5 text-gray-400 border-white/10' }} hover:bg-brand hover:text-darkbg hover:border-brand transition-all">
                {{ app()->getLocale() === 'km' ? 'EN' : 'KH' }}
            </a>
            @auth
                <a href="{{ route('orders.my') }}" class="relative p-2.5 rounded-full bg-white/5 border border-white/10 hover:bg-white/10 transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-hover:text-brand transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    @php $orderCount = auth()->user()->orders()->whereNotIn('status', ['delivered', 'completed', 'cancelled'])->count(); @endphp
                    @if($orderCount > 0)
                        <span class="absolute -top-1 -right-1 w-5 h-5 bg-brand text-darkbg text-[10px] font-bold rounded-full flex items-center justify-center border-2 border-[#0f1115]">{{ $orderCount }}</span>
                    @endif
                </a>
                <a href="{{ route('orders.my') }}" class="text-xs font-bold uppercase tracking-wider px-4 py-2 bg-brand/10 text-brand border border-brand/20 rounded-full hover:bg-brand hover:text-darkbg transition-all hidden sm:inline-block">
                    {{ __('My Orders') }}
                </a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('dashboard') }}" class="text-xs font-bold uppercase tracking-wider px-4 py-2 bg-white/5 text-gray-300 border border-white/10 rounded-full hover:bg-white/10 hover:text-white transition-all hidden sm:inline-block">
                        {{ __('Console') }}
                    </a>
                @endif
            @else
                <a href="{{ route('register') }}" class="text-xs font-bold uppercase tracking-wider px-4 py-2 bg-brand/10 text-brand border border-brand/20 rounded-full hover:bg-brand hover:text-darkbg transition-all">
                    {{ __('Register') }}
                </a>
                <a href="{{ route('login') }}" class="text-xs font-bold uppercase tracking-wider px-4 py-2 bg-white/5 text-gray-300 border border-white/10 rounded-full hover:bg-white/10 hover:text-white transition-all">
                    {{ __('Sign In') }}
                </a>
            @endauth
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="border-t border-[var(--border)] bg-[var(--footer-bg)] py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <a href="#" class="text-2xl font-extrabold tracking-wider text-white">VOLT<span class="text-brand">.</span></a>
                    <p class="text-sm text-gray-500 mt-3 font-light leading-relaxed">{{ __('Premium electric bicycles engineered for the modern commute.') }}</p>
                </div>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">{{ __('Quick Links') }}</h4>
                    <div class="space-y-2 text-sm">
                        <a href="/" class="block text-gray-500 hover:text-brand transition-colors">{{ __('Home') }}</a>
                        <a href="/#categories" class="block text-gray-500 hover:text-brand transition-colors">{{ __('Categories') }}</a>
                        <a href="/#bikes" class="block text-gray-500 hover:text-brand transition-colors">{{ __('E-Bikes') }}</a>
                    </div>
                </div>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">{{ __('Support') }}</h4>
                    <div class="space-y-2 text-sm">
                        <a href="#" class="block text-gray-500 hover:text-brand transition-colors">{{ __('Contact Us') }}</a>
                        <a href="#" class="block text-gray-500 hover:text-brand transition-colors">{{ __('Warranty') }}</a>
                        <a href="#" class="block text-gray-500 hover:text-brand transition-colors">{{ __('Shipping') }}</a>
                    </div>
                </div>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">{{ __('Connect') }}</h4>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:bg-brand hover:text-darkbg hover:border-brand transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:bg-brand hover:text-darkbg hover:border-brand transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.38-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.11 2.525c.636-.247 1.363-.416 2.427-.465C8.83 2.013 9.175 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:bg-brand hover:text-darkbg hover:border-brand transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-[var(--border)] pt-8 text-center text-sm text-gray-500">
                <p>&copy; 2026 VOLT E-Bikes. Engineered for the future.</p>
            </div>
        </div>
    </footer>

    <script>
        (function() {
            const saved = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', saved);
            document.addEventListener('DOMContentLoaded', function() {
                const moon = document.getElementById('moon-icon');
                const sun = document.getElementById('sun-icon');
                if (moon) moon.classList.toggle('hidden', saved === 'dark');
                if (sun) sun.classList.toggle('hidden', saved === 'light');
            });
        })();
        function toggleTheme() {
            const current = document.documentElement.getAttribute('data-theme');
            const next = current === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);
            document.getElementById('moon-icon')?.classList.toggle('hidden', next === 'dark');
            document.getElementById('sun-icon')?.classList.toggle('hidden', next === 'light');
        }
    </script>

    @include('partials.chat-widget')
</body>
</html>