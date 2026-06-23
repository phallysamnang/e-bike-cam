<nav x-data="{ open: false }" class="bg-[#0f1115] border-b border-white/5 fixed top-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="text-2xl font-extrabold tracking-wider text-white flex items-center gap-1">
                    VOLT<span class="text-[#00ff66] text-3xl leading-none">.</span>
                </a>
            </div>

            <div class="hidden sm:flex space-x-8">
                <a href="{{ route('dashboard') }}" class="text-sm font-semibold tracking-wide {{ request()->routeIs('dashboard') ? 'text-[#00ff66]' : 'text-gray-400 hover:text-white' }} transition-colors">
                    Dashboard
                </a>
                <a href="#" class="text-sm font-semibold tracking-wide text-gray-400 hover:text-white transition-colors">
                    Categories
                </a>
                <a href="#" class="text-sm font-semibold tracking-wide text-gray-400 hover:text-white transition-colors">
                    E-Bikes
                </a>
                <a href="#" class="text-sm font-semibold tracking-wide text-gray-400 hover:text-white transition-colors">
                    Technology
                </a>
            </div>

            <div class="hidden sm:flex items-center sm:ms-6">
                <div class="relative flex items-center gap-4">
                    <span class="relative inline-flex items-center p-2 text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-[#00ff66] rounded-full"></span>
                    </span>

                    <span class="text-sm font-bold text-gray-300 border-l border-white/10 pl-4">
                        {{ Auth::user()->name ?? 'Admin Profile' }}
                    </span>
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-white/5 bg-[#0f1115]/95 backdrop-blur-lg">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="#" class="block px-3 py-2.5 rounded-xl text-base font-medium text-[#00ff66] bg-white/5">Dashboard</a>
            <a href="#" class="block px-3 py-2.5 rounded-xl text-base font-medium text-gray-400 hover:text-white">Categories</a>
            <a href="#" class="block px-3 py-2.5 rounded-xl text-base font-medium text-gray-400 hover:text-white">E-Bikes</a>
        </div>
    </div>
</nav>