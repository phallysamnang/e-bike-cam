@auth
<div id="chat-container" class="fixed bottom-6 right-6 z-[100]">
    <div id="chat-panel" class="fixed bottom-24 right-6 w-80 sm:w-96 h-96 rounded-2xl shadow-2xl flex flex-col overflow-hidden border" style="display:none;background-color:var(--bg-card);border-color:var(--border);">
        <div class="bg-brand text-darkbg px-5 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-darkbg/20 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                </div>
                <div>
                    <p class="text-sm font-black" style="color:#0f1115">{{ __('Support Chat') }}</p>
                    <p class="text-[10px] font-semibold flex items-center gap-1" style="color:rgba(15,17,21,0.7)">
                        <span class="w-1.5 h-1.5 rounded-full inline-block" style="background-color:#0f1115"></span>
                        {{ __('Online') }}
                    </p>
                </div>
            </div>
            <button onclick="closeChat()" class="transition-colors" style="color:rgba(15,17,21,0.6)">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-3" style="background-color:var(--bg-body);">
            <div id="chat-empty" class="flex flex-col items-center justify-center h-full text-center py-8">
                <div class="w-14 h-14 rounded-full flex items-center justify-center mb-4" style="background-color:var(--bg-glass-hover)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color:var(--text-muted)"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                </div>
                <p class="text-sm font-medium" style="color:var(--text-secondary)">{{ __('Send us a message') }}</p>
                <p class="text-xs mt-1" style="color:var(--text-muted)">{{ __('We typically reply within minutes') }}</p>
            </div>
        </div>

        <div class="p-3 flex gap-2" style="border-top:1px solid var(--border);">
            <input id="chat-input" type="text" placeholder="{{ __('Type your message...') }}" class="flex-1 rounded-xl px-4 py-2.5 text-sm placeholder-gray-500 focus:outline-none" style="background-color:var(--bg-glass-hover);border:1px solid var(--border);color:var(--text-primary)">
            <button onclick="sendMessage()" id="chat-send-btn" class="font-bold px-4 py-2.5 rounded-xl text-sm transition-all flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed" style="background-color:#00ff66;color:#0f1115">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
            </button>
        </div>
    </div>

    <button onclick="toggleChat()" id="chat-bubble" class="w-14 h-14 rounded-full shadow-xl transition-all flex items-center justify-center relative" style="background-color:#00ff66;color:#0f1115">
        <svg id="chat-bubble-icon" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
        <svg id="chat-close-icon" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display:none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        <span id="chat-unread-badge" class="absolute -top-1.5 -right-1.5 w-6 h-6 bg-red-500 text-white text-[10px] font-black rounded-full flex items-center justify-center border-2" style="display:none;border-color:var(--bg-card)">0</span>
    </button>
</div>

<script>
let chatOpen = false;
let chatMessages = [];
let chatPollTimer = null;
let chatUnreadTimer = null;

document.addEventListener('DOMContentLoaded', function () {
    checkUnread();
});

function toggleChat() {
    chatOpen = !chatOpen;
    document.getElementById('chat-panel').style.display = chatOpen ? 'flex' : 'none';
    document.getElementById('chat-bubble-icon').style.display = chatOpen ? 'none' : 'block';
    document.getElementById('chat-close-icon').style.display = chatOpen ? 'block' : 'none';

    if (chatOpen) {
        fetchMessages();
        chatPollTimer = setInterval(fetchMessages, 5000);
    } else {
        if (chatPollTimer) clearInterval(chatPollTimer);
    }
}

function closeChat() {
    chatOpen = false;
    document.getElementById('chat-panel').style.display = 'none';
    document.getElementById('chat-bubble-icon').style.display = 'block';
    document.getElementById('chat-close-icon').style.display = 'none';
    if (chatPollTimer) clearInterval(chatPollTimer);
}

async function fetchMessages() {
    try {
        const res = await fetch('/chat/messages');
        if (!res.ok) return;
        const data = await res.json();
        chatMessages = data;
        renderMessages();
    } catch (e) {}
}

async function sendMessage() {
    const input = document.getElementById('chat-input');
    const text = input.value.trim();
    if (!text) return;

    document.getElementById('chat-send-btn').disabled = true;

    try {
        const res = await fetch('/chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ message: text }),
        });
        if (res.ok) {
            input.value = '';
            await fetchMessages();
        }
    } catch (e) {}
    document.getElementById('chat-send-btn').disabled = false;
}

async function checkUnread() {
    try {
        const res = await fetch('/chat/unread');
        if (!res.ok) return;
        const data = await res.json();
        const badge = document.getElementById('chat-unread-badge');
        if (data.count > 0) {
            badge.textContent = data.count;
            badge.style.display = 'flex';
        } else {
            badge.style.display = 'none';
        }
    } catch (e) {}
    chatUnreadTimer = setTimeout(checkUnread, 15000);
}

function renderMessages() {
    const container = document.getElementById('chat-messages');
    const empty = document.getElementById('chat-empty');

    if (!chatMessages.length) {
        if (empty) empty.style.display = 'flex';
        return;
    }
    if (empty) empty.style.display = 'none';

    container.innerHTML = '';
    chatMessages.forEach(function (msg) {
        const wrapper = document.createElement('div');
        wrapper.className = 'flex flex-col ' + (msg.is_from_admin ? 'mr-8' : 'ml-8');

        const bubble = document.createElement('div');
        bubble.className = 'px-4 py-2.5 rounded-2xl text-sm leading-relaxed max-w-full break-words';
        if (msg.is_from_admin) {
            bubble.style.backgroundColor = 'var(--bg-glass-strong)';
            bubble.style.color = 'var(--text-primary)';
        } else {
            bubble.style.backgroundColor = '#00ff66';
            bubble.style.color = '#0f1115';
        }
        bubble.textContent = msg.message;

        const time = document.createElement('span');
        time.className = 'text-[10px] mt-1' + (msg.is_from_admin ? '' : ' text-right');
        time.style.color = 'var(--text-muted)';
        time.textContent = formatTime(msg.created_at);

        wrapper.appendChild(bubble);
        wrapper.appendChild(time);
        container.appendChild(wrapper);
    });

    container.scrollTop = container.scrollHeight;
}

function formatTime(dateStr) {
    const d = new Date(dateStr);
    return d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
}

document.addEventListener('keydown', function (e) {
    if (e.key === 'Enter' && chatOpen && document.activeElement === document.getElementById('chat-input')) {
        sendMessage();
    }
});
</script>
@endauth
