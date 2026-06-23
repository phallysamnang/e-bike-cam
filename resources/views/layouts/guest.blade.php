<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>VOLT | {{ __('Sign In') }}</title>

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
                --bg-glass: rgba(255, 255, 255, 0.02);
                --bg-glass-hover: rgba(255, 255, 255, 0.05);
                --text-primary: #fff;
                --text-secondary: #9ca3af;
                --border: rgba(255, 255, 255, 0.05);
                --border-strong: rgba(255, 255, 255, 0.1);
                --scrollbar-track: #0f1115;
                --scrollbar-thumb: #1f2937;
            }
            [data-theme="light"] {
                --bg-body: #f8fafc;
                --bg-card: #ffffff;
                --bg-glass: rgba(0, 0, 0, 0.02);
                --bg-glass-hover: rgba(0, 0, 0, 0.05);
                --text-primary: #0f172a;
                --text-secondary: #64748b;
                --border: rgba(0, 0, 0, 0.06);
                --border-strong: rgba(0, 0, 0, 0.1);
                --scrollbar-track: #f1f5f9;
                --scrollbar-thumb: #cbd5e1;
            }
            body { background-color: var(--bg-body); color: var(--text-primary); }
            ::-webkit-scrollbar { width: 6px; }
            ::-webkit-scrollbar-track { background: var(--scrollbar-track); }
            ::-webkit-scrollbar-thumb { background: var(--scrollbar-thumb); border-radius: 4px; }
            [data-theme="light"] .text-white { color: var(--text-primary); }
            [data-theme="light"] .text-gray-400 { color: var(--text-secondary); }
            [data-theme="light"] .text-gray-500 { color: #94a3b8; }
            [data-theme="light"] .border-white\/5 { border-color: var(--border); }
            [data-theme="light"] .bg-white\/\[0\.02\] { background-color: var(--bg-glass); }
        </style>
        @vite(['resources/css/app.css'])
    </head>
    <body class="antialiased {{ app()->getLocale() === 'km' ? 'font-khmer' : 'font-sans' }}">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background-color: var(--bg-body);">
            <div class="mb-8 flex items-center gap-4">
                <a href="/" class="text-4xl font-extrabold tracking-wider" style="color: var(--text-primary);">
                    VOLT<span class="text-brand">.</span>
                </a>
                <button onclick="toggleTheme()" class="p-2.5 rounded-full bg-white/5 border border-white/10 hover:bg-white/10 transition-all group" title="Toggle theme">
                    <svg id="moon-icon-guest" class="w-4 h-4 text-gray-400 group-hover:text-brand transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg id="sun-icon-guest" class="w-4 h-4 text-gray-400 group-hover:text-brand transition-colors hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>
            </div>

            <div class="w-full sm:max-w-md">
                <div class="bg-[var(--bg-glass)] border border-[var(--border)] rounded-[2rem] p-8 backdrop-blur-xl shadow-2xl">
                    {{ $slot }}

                    <div class="mt-6 text-center">
                        <p class="text-xs text-gray-500">
                            &copy; {{ date('Y') }} VOLT E-Bikes
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <script>
        (function() {
            const saved = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', saved);
            document.addEventListener('DOMContentLoaded', function() {
                const moon = document.getElementById('moon-icon-guest');
                const sun = document.getElementById('sun-icon-guest');
                if (moon) moon.classList.toggle('hidden', saved === 'dark');
                if (sun) sun.classList.toggle('hidden', saved === 'light');
            });
        })();
        function toggleTheme() {
            const current = document.documentElement.getAttribute('data-theme');
            const next = current === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);
            document.getElementById('moon-icon-guest')?.classList.toggle('hidden', next === 'dark');
            document.getElementById('sun-icon-guest')?.classList.toggle('hidden', next === 'light');
        }
    </script>
    </body>
</html>
