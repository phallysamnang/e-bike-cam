<x-admin-layout>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] p-6">
                <a href="{{ route('admin.chat.index') }}" class="flex items-center gap-2 text-gray-400 hover:text-white text-sm font-semibold mb-4 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    {{ __('Back') }}
                </a>

                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-3">{{ __('Conversations') }}</p>

                @php $users = \App\Models\User::whereHas('messages')->get(); @endphp
                @foreach($users as $u)
                    <a href="{{ route('admin.chat.conversation', $u) }}" class="flex items-center gap-3 p-3 rounded-xl transition-all group {{ $u->id === $user->id ? 'bg-brand/10 border border-brand/20' : 'hover:bg-white/5' }}">
                        <div class="w-10 h-10 rounded-full {{ $u->id === $user->id ? 'bg-brand text-darkbg' : 'bg-white/5 text-gray-400' }} font-black flex items-center justify-center text-sm">
                            {{ substr($u->name, 0, 2) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold {{ $u->id === $user->id ? 'text-brand' : 'text-white' }} truncate">{{ $u->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ $u->email }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white/[0.02] border border-white/5 rounded-[2rem] flex flex-col overflow-hidden" style="height: 600px;">
                <div class="px-6 py-4 border-b border-white/5 flex items-center gap-3 flex-shrink-0">
                    <div class="w-10 h-10 rounded-full bg-brand/10 text-brand font-black flex items-center justify-center text-sm">
                        {{ substr($user->name, 0, 2) }}
                    </div>
                    <div>
                        <h2 class="text-lg font-black text-white">{{ $user->name }}</h2>
                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                    </div>
                </div>

                <div id="admin-chat-messages" class="flex-1 overflow-y-auto p-6 space-y-4">
                    <div id="admin-chat-empty" class="flex items-center justify-center h-full text-center">
                        <div>
                            <p class="text-gray-500">{{ __('No messages yet') }}</p>
                            <p class="text-gray-600 text-xs mt-1">{{ __('Send a reply to start the conversation') }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 border-t border-white/5 flex-shrink-0">
                    <form id="admin-chat-form" class="flex gap-2">
                        @csrf
                        <input id="admin-chat-input" type="text" placeholder="{{ __('Type your reply...') }}" name="message" class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-brand transition-colors">
                        <button id="admin-chat-send-btn" type="submit" class="bg-brand text-darkbg font-bold px-4 py-2.5 rounded-xl text-sm hover:bg-brand/90 transition-all flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                            {{ __('Send') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const adminUserId = {{ $user->id }};
        let adminMessages = @json($messages);
        let adminPollTimer = null;

        document.addEventListener('DOMContentLoaded', function () {
            renderAdminMessages();
            adminPollTimer = setInterval(fetchAdminMessages, 5000);
            document.getElementById('admin-chat-form').addEventListener('submit', function (e) {
                e.preventDefault();
                sendAdminReply();
            });
        });

        async function fetchAdminMessages() {
            try {
                const res = await fetch('/admin/chat/' + adminUserId + '/messages');
                if (!res.ok) return;
                adminMessages = await res.json();
                renderAdminMessages();
            } catch (e) {}
        }

        async function sendAdminReply() {
            const input = document.getElementById('admin-chat-input');
            const text = input.value.trim();
            if (!text) return;

            document.getElementById('admin-chat-send-btn').disabled = true;

            try {
                const res = await fetch('/admin/chat/' + adminUserId + '/send-reply', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ message: text }),
                });
                if (res.ok) {
                    input.value = '';
                    await fetchAdminMessages();
                }
            } catch (e) {}
            document.getElementById('admin-chat-send-btn').disabled = false;
        }

        function renderAdminMessages() {
            const container = document.getElementById('admin-chat-messages');
            const empty = document.getElementById('admin-chat-empty');

            if (!adminMessages.length) {
                if (empty) empty.style.display = 'flex';
                return;
            }
            if (empty) empty.style.display = 'none';

            container.innerHTML = '';
            adminMessages.forEach(function (msg) {
                const outer = document.createElement('div');
                outer.className = 'flex flex-col ' + (msg.is_from_admin ? 'ml-12' : 'mr-12');

                const bubble = document.createElement('div');
                bubble.className = 'px-4 py-2.5 rounded-2xl text-sm leading-relaxed max-w-[80%] break-words';
                if (msg.is_from_admin) {
                    bubble.style.backgroundColor = 'var(--bg-glass-strong)';
                    bubble.style.color = 'var(--text-primary)';
                } else {
                    bubble.style.backgroundColor = '#00ff66';
                    bubble.style.color = '#0f1115';
                }
                bubble.textContent = msg.message;

                const time = document.createElement('span');
                time.className = 'text-[10px] text-gray-500 mt-1';
                time.style.textAlign = msg.is_from_admin ? 'left' : 'right';
                time.textContent = formatAdminTime(msg.created_at);

                outer.appendChild(bubble);
                outer.appendChild(time);
                container.appendChild(outer);
            });

            container.scrollTop = container.scrollHeight;
        }

        function formatAdminTime(dateStr) {
            return new Date(dateStr).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }
    </script>
</x-admin-layout>
