<x-admin-layout>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-6">
                <h2 class="text-lg font-black text-white mb-4">{{ __('Chat Conversations') }}</h2>

                @if($recent->count())
                    <div class="space-y-3 mb-6">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-red-400 flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-400 inline-block"></span>
                            {{ __('New Messages') }}
                        </p>
                        @foreach($recent as $msg)
                            <a href="{{ route('admin.chat.conversation', $msg->user) }}" class="flex items-center gap-3 p-3 rounded-xl bg-white/[0.02] hover:bg-white/5 border border-white/5 transition-all">
                                <div class="w-10 h-10 rounded-full bg-brand/10 text-brand font-black flex items-center justify-center text-sm">
                                    {{ substr($msg->user->name, 0, 2) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-white truncate">{{ $msg->user->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Str::limit($msg->message, 40) }}</p>
                                </div>
                                <span class="text-[10px] text-gray-500 flex-shrink-0">{{ $msg->created_at->diffForHumans() }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif

                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-3">{{ __('All Users') }}</p>
                @forelse($users as $user)
                    <a href="{{ route('admin.chat.conversation', $user) }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-all group">
                        <div class="w-10 h-10 rounded-full bg-white/5 text-gray-400 font-black flex items-center justify-center text-sm group-hover:bg-brand/10 group-hover:text-brand transition-all">
                            {{ substr($user->name, 0, 2) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-white truncate">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                        </div>
                        @if($user->unread_count > 0)
                            <span class="px-2 py-0.5 rounded-full bg-red-500/10 text-red-400 text-[10px] font-bold">{{ $user->unread_count }}</span>
                        @endif
                    </a>
                @empty
                    <p class="text-gray-500 text-sm text-center py-8">{{ __('No conversations yet') }}</p>
                @endforelse
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-8 flex flex-col items-center justify-center min-h-[400px]">
                <div class="w-20 h-20 rounded-full bg-white/5 flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">{{ __('Select a conversation') }}</h3>
                <p class="text-sm text-gray-500 text-center max-w-sm">{{ __('Choose a user from the left to view and reply to their messages') }}</p>
            </div>
        </div>
    </div>
</x-admin-layout>
