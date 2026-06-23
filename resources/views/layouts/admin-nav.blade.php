<nav class="bg-[#0f1115] border-b border-white/5 fixed top-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="text-2xl font-extrabold tracking-wider text-white">
                    VOLT<span class="text-[#00ff66]">.</span>
                </a>
                <span class="px-2.5 py-0.5 rounded-md text-[10px] font-black uppercase tracking-widest bg-[#00ff66]/10 text-[#00ff66] border border-[#00ff66]/20">
                    Console
                </span>
            </div>

            <div class="hidden sm:flex space-x-8">
                <a href="{{ route('dashboard') }}" class="text-xs font-bold uppercase tracking-wider text-[#00ff66]">
                    Metrics Overview
                </a>
                <a href="{{ route('products.index') }}" class="text-xs font-bold uppercase tracking-wider text-gray-400 hover:text-white transition-colors">
                    Products
                </a>
                <a href="{{ route('categories.index') }}" class="text-xs font-bold uppercase tracking-wider text-gray-400 hover:text-white transition-colors">
                    Categories
                </a>
            </div>

            <div class="hidden sm:flex items-center gap-4">
                <div class="flex items-center gap-3 bg-white/5 border border-white/5 rounded-xl py-1.5 px-3">
                    <div class="w-2 h-2 rounded-full bg-[#00ff66] animate-pulse"></div>
                    <span class="text-xs font-bold text-gray-200">
                        {{ Auth::user()->name ?? 'Administrator' }}
                    </span>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="text-xs font-bold text-red-400 hover:text-red-300 uppercase tracking-wider transition-colors pl-2">
                        Exit
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>